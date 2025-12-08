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
            'no_hp'             => 'required|string|max:15',
            'alamat_pengiriman' => 'required|string',
            'catatan'           => 'nullable|string',
            'total_diskon'      => 'nullable|numeric',
            'metode_pembayaran' => 'required|in:midtrans,cod',
        ]);

        $product = Produk::findOrFail($validated['product_id']);

        // Normalisasi nomor HP
        $phoneNumber = $validated['no_hp'];
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber); // Hapus semua selain angka

        if (substr($phoneNumber, 0, 2) === '62') {
            $phoneNumber = '0' . substr($phoneNumber, 2); // Ganti 62 dengan 0
        }

        $subtotal      = $product->harga_jual * $validated['quantity'];
        $total_diskon  = $validated['total_diskon'] ?? 0;
        $total_akhir   = $subtotal - $total_diskon;
        $invoice_number = 'INV-' . strtoupper(uniqid());

        // Simpan order
        $order = Order::create([
            'customer_id'        => $validated['customer_id'],
            'no_hp'              => $phoneNumber,
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

        // Simpan payment dengan semua kolom yang diperlukan
        Payment::create([
            'order_id'          => $order->id,
            'jenis_pembayaran'  => 'full',
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'total_order'       => $total_akhir,
            'jumlah_terbayar'   => 0,
            'sisa_pembayaran'   => $total_akhir, 
            'pembayaran_status' => 'unpaid',
        ]);

        return redirect()->route('customer.orders.preview.show', $order->id);
    }

    // Halaman preview
    public function showPreview(Request $request, Order $order)
    {
        // Secara default, tampilkan tombol bayar, kecuali action=view
        $show_payment_button = $request->query('action') !== 'view';

        // Hanya tampilkan tombol jika status masih 'pending'
        if ($order->status !== 'pending') {
            $show_payment_button = false;
        }

        $snap_token = null;

        // Buat Snap Token hanya jika tombol bayar akan ditampilkan & metode pembayaran adalah Midtrans
        if ($show_payment_button && $order->payment->metode_pembayaran === 'midtrans') {
            // Jika sudah ada snap_token, gunakan yang lama
            if ($order->payment->snap_token) {
                $snap_token = $order->payment->snap_token;
            } else {
                // Jika belum ada, buat baru
                Config::$serverKey    = config('midtrans.server_key');
                Config::$isSanitized  = true;
                Config::$isProduction = false;

                $transaction = [
                    'transaction_details' => [
                        'order_id'     => $order->invoice_number,
                        'gross_amount' => $order->total_harga_akhir,
                    ],
                    'customer_details' => [
                        'first_name' => $order->customer->name,
                        'phone'      => $order->no_hp,
                    ],
                ];

                try {
                    $snap_token = Snap::getSnapToken($transaction);
                    // Simpan token agar tidak generate ulang
                    $order->payment->update(['snap_token' => $snap_token]);
                } catch (\Exception $e) {
                    return back()->with('error', 'Gagal membuat payment Midtrans: ' . $e->getMessage());
                }
            }
        }

        return view('frontend.checkout.preview_pemesanan', compact('order', 'snap_token', 'show_payment_button'));
    }

    // Proses pembayaran
    public function pay(Request $request, Order $order)
    {
        // COD → tidak pakai Midtrans
        if ($order->payment->metode_pembayaran === 'cod') {
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



    // Halaman sukses
    public function success(Order $order)
    {
        return view('frontend.checkout.success', compact('order'));
    }
}
