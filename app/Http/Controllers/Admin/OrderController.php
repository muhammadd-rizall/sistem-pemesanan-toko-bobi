<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Penjualan;

class OrderController extends Controller
{

    //
    // Menampilkan daftar order dengan fitur pencarian
    //
    public function index()
    {
        $search = request()->query('search');
        $orders = Order::with('customer')
            ->when($search, function ($query, $search) {
                return $query->where('id', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.backend.order.list_order', compact('orders', 'search'));
    }

    //
    // Menampilkan detail order order
    //
    public function showOrder($id)
    {
        $order = Order::with('customer', 'diskon', 'orderItems.product')->findOrFail($id);
        return view('admin.backend.order.show_order', compact('order'));
    }


    //
    //menghapus order
    //
    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('listOrder')->with('success', 'Order berhasil dihapus.');
    }


    //
    //memperbarui status pengiriman
    //
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,dikirim,selesai,cancelled',
        ]);

        // Update status
        $order->status = $request->status;
        $order->save();

        // 🔗 PENGAIT KE LAPORAN PENJUALAN (relasi logis)
        if (strtolower(trim($request->status)) === 'selesai') {

            // Cegah double insert
            if (!$order->penjualan) {

                // Ambil customer name
                $customerName = $order->customer ? $order->customer->name : 'Unknown';

                // Ambil produk pertama dari orderItems
                $firstItem = $order->orderItems()->with('product')->first();
                if ($firstItem) {
                    $produk_id = $firstItem->product->id;
                    $harga_satuan = $firstItem->harga_satuan ?? $firstItem->product->harga_jual;
                    $jumlah = $firstItem->jumlah ?? 1;

                    Penjualan::create([
                        'kode_penjualan' => $order->invoice_number, // pengait logis
                        'tanggal' => now(),
                        'produk_id' => $produk_id,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $harga_satuan,
                        'total' => $harga_satuan * $jumlah,
                        'pembeli' => $customerName,
                        'keterangan' => 'Otomatis dari order #' . $order->id,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }


}
