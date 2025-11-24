<?php

namespace App\Http\Controllers\checkout;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Produk;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // Form pemesanan
    public function create(Produk $product)
    {
        $diskon = $product->diskon()
            ->where('status', 'active')
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_berakhir', '>=', now())
            ->first();

        return view('frontend.checkout.form_pemesanan', compact('product', 'diskon'));
    }

    // Preview pesanan
    public function preview(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:produks,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
            'no_hp' => 'required|string|max:13',
            'alamat_pengiriman' => 'required|string',
            'catatan' => 'nullable|string',
            'total_diskon' => 'nullable|numeric',
        ]);

        $product = Produk::findOrFail($validated['product_id']);
        $subtotal = $product->harga_jual * $validated['quantity'];
        $total_diskon = $validated['total_diskon'] ?? 0;
        $total_akhir = $subtotal - $total_diskon;

        // Generate invoice number unik
        $invoice_number = 'INV-' . strtoupper(uniqid());

        // Simpan order
        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'no_hp' => $validated['no_hp'],
            'alamat_pengiriman' => $validated['alamat_pengiriman'],
            'catatan' => $validated['catatan'],
            'total_harga_awal' => $subtotal,
            'total_diskon' => $total_diskon,
            'total_harga_akhir' => $total_akhir,
            'status' => 'pending',
            'invoice_number' => $invoice_number,
        ]);

        // Simpan order item
        OrderItem::create([
            'order_id' => $order->id,
            'produk_id' => $product->id,
            'quantity' => $validated['quantity'],
            'harga_satuan' => $product->harga_jual,
            'harga_total' => $subtotal,
        ]);

        // Redirect ke halaman preview
        return redirect()->route('customer.orders.preview.show', $order->id);
    }

    // Halaman preview
    public function showPreview(Order $order)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isSanitized = true;
        Config::$isProduction = false;

        // Data transaksi
        $transaction = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_harga_akhir,
            ],
            'customer_details' => [
                'first_name' => $order->customer->name,
                'phone' => $order->no_hp,
            ],
        ];

        try {
            $snap_token = Snap::getSnapToken($transaction);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat payment Midtrans: ' . $e->getMessage());
        }

        return view('frontend.checkout.preview_pemesanan', compact('order', 'snap_token'));
    }


    // Proses pembayaran
    public function pay(Request $request, Order $order)
    {
        // $order->update([
        //     'status' => 'proses',
        //     'pembayaran_status' => 'lunas',
        // ]);

        return redirect()->route('customer.orders.preview.show', $order);
    }

    // Halaman sukses
    public function midtransCallback(Request $request)
    {
        $order_id = $request->order_id;
        $transaction_status = $request->transaction_status;

        $order = Order::find($order_id);

        if (!$order) return response()->json(['error' => 'Order not found'], 404);

        if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
            $order->update([
                'status' => 'proses',
                'pembayaran_status' => 'lunas',
            ]);
        } elseif ($transaction_status == 'pending') {
            $order->update([
                'status' => 'pending',
                'pembayaran_status' => 'pending',
            ]);
        } elseif ($transaction_status == 'deny' || $transaction_status == 'cancel' || $transaction_status == 'expire') {
            $order->update([
                'status' => 'cancelled',
                'pembayaran_status' => 'pending',
            ]);
        }

        return response()->json(['message' => 'OK']);
    }

    // Halaman sukses pembayaran
    public function success(Order $order)
    {
        // Bisa dikustom sesuai Blade yang kamu punya
        return view('frontend.checkout.success', compact('order'));
    }
}
