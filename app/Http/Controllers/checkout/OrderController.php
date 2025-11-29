<?php

namespace App\Http\Controllers\Checkout;

use App\Models\Order;
use App\Models\Produk;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Midtrans\Config;
use Midtrans\Snap;

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
            'product_id'        => 'required|exists:produks,id',
            'customer_id'       => 'required|exists:customers,id',
            'quantity'          => 'required|integer|min:1',
            'no_hp'             => 'required|string|max:13',
            'alamat_pengiriman' => 'required|string',
            'catatan'           => 'nullable|string',
            'total_diskon'      => 'nullable|numeric',
            'metode_pembayaran' => 'required|in:midtrans,cod', // COD
        ]);

        $product = Produk::findOrFail($validated['product_id']);

        $subtotal      = $product->harga_jual * $validated['quantity'];
        $total_diskon  = $validated['total_diskon'] ?? 0;
        $total_akhir   = $subtotal - $total_diskon;
        $invoice_number = 'INV-' . strtoupper(uniqid());

        // Simpan order
        $order = Order::create([
            'customer_id'        => $validated['customer_id'],
            'no_hp'              => $validated['no_hp'],
            'alamat_pengiriman'  => $validated['alamat_pengiriman'],
            'catatan'            => $validated['catatan'],
            'total_harga_awal'   => $subtotal,
            'total_diskon'       => $total_diskon,
            'total_harga_akhir'  => $total_akhir,
            'status'             => 'pending',
            'invoice_number'     => $invoice_number,
        ]);

        // Simpan order item
        OrderItem::create([
            'order_id'     => $order->id,
            'produk_id'    => $product->id,
            'quantity'     => $validated['quantity'],
            'harga_satuan' => $product->harga_jual,
            'harga_total'  => $subtotal,
        ]);

        // Simpan payment
        Payment::create([
            'order_id'          => $order->id,
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'total_order'       => $total_akhir,
            'pembayaran_status' => 'unpaid',
        ]);

        return redirect()->route('customer.orders.preview.show', $order->id);
    }

    // Halaman preview
    public function showPreview(Order $order)
    {
        $snap_token = null;
        // Jika COD → langsung ke halaman preview tanpa Snap Token
        if ($order->payment->metode_pembayaran === 'cod') { // COD
            return view('frontend.checkout.preview_pemesanan', compact('order', 'snap_token'));
        }

        // Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isSanitized  = true;
        Config::$isProduction = false;

        $transaction = [
            'transaction_details' => [
                'order_id'     => $order->payment->id,
                'gross_amount' => $order->total_harga_akhir,
            ],
            'customer_details' => [
                'first_name' => $order->customer->name,
                'phone'      => $order->no_hp,
            ],
        ];

        try {
            $snap_token = Snap::getSnapToken($transaction);
            $order->payment->update(['snap_token' => $snap_token]);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat payment Midtrans: ' . $e->getMessage());
        }

        return view('frontend.checkout.preview_pemesanan', compact('order', 'snap_token'));
    }


    // Proses pembayaran
    public function pay(Request $request, Order $order)
    {
        // COD → tidak pakai Midtrans
        if ($order->payment->metode_pembayaran === 'cod') { // COD
            // COD = pembayaran nanti, jadi unpaid
            $order->payment->update([
                'pembayaran_status' => 'unpaid',
            ]);
            $order->update([
                'status' => 'proses',
            ]);

            return redirect()->route('customer.orders.success', $order);
        }

        // Midtrans (logika lama tetap)
        return redirect()->route('customer.orders.preview.show', $order);
    }


    // Midtrans callback
    public function midtransCallback(Request $request)
    {
        $payment_id         = $request->order_id;
        $transaction_status = $request->transaction_status;

        $payment = Payment::find($payment_id);

        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }
        $order = $payment->order;

        // Callback hanya untuk MIDTRANS
        if ($payment->metode_pembayaran === 'cod') { // COD
            return response()->json(['message' => 'COD does not use callback']);
        }

        if ($transaction_status === 'capture' || $transaction_status === 'settlement') {
            $payment->update(['pembayaran_status' => 'paid']);
            $order->update(['status' => 'proses']);
        } elseif ($transaction_status === 'pending') {
            $payment->update(['pembayaran_status' => 'pending']);
            $order->update(['status' => 'pending']);
        } elseif (in_array($transaction_status, ['deny', 'cancel', 'expire'])) {
            $payment->update(['pembayaran_status' => 'failed']);
            $order->update(['status' => 'cancelled']);
        }

        return response()->json(['message' => 'OK']);
    }


    // Halaman sukses
    public function success(Order $order)
    {
        return view('frontend.checkout.success', compact('order'));
    }
}
