<?php

namespace App\Http\Controllers\checkout;

use App\Models\Order;
use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class OrderController extends Controller
{
    public function formPemesanan($id)
    {

        $product = Produk::findOrFail($id);

        // Logika untuk menampilkan formulir pemesanan berdasarkan ID produk
        return view('frontend.checkout.form_pemesanan', compact('product'));
    }

    public function orderStore(Request $request)
    {
        $validated = $request->validate([
           'custumer_id' => 'required|exists:customers,id',
           'diskon_id' => 'nullable|exists:diskons,id',
           'total_harga_awal' => 'required|numeric|min:0',
           'total_diskon' => 'nullable|numeric|min:0',
           'total_harga_akhir' => 'required|numeric|min:0',
           'alamat_pengiriman' => 'required|string',
           'catatan' => 'nullable|string',
           'status' => 'required|in:pending,proses,dikirim,cancelled',
           'pembayaran_status' => 'required|in:pending,lunas,belum_lunas',
        ]);

        Order::create([
           'custumer_id' => $validated['custumer_id'],
           'diskon_id' => $validated['diskon_id'],
           'total_harga_awal' => $validated['total_harga_awal'],
           'total_diskon' => $validated['total_diskon'],
           'total_harga_akhir' => $validated['total_harga_akhir'],
           'alamat_pengiriman' => $validated['alamat_pengiriman'],
           'catatan' => $validated['catatan'],
           'status' => $validated['status'],
           'pembayaran_status' => $validated['pembayaran_status'],
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Order berhasil dibuat!');
    }
}
