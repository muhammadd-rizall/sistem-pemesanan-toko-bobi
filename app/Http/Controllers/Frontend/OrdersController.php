<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function pesanan(Request $request)
    {
        $status = $request->get('status');
        $showAll = $request->get('show');

        $customerId = Auth::guard('customer')->id();

        // Total statistik
        $totalPesanan = Order::where('customer_id', $customerId)->count();
        $totalBelanja = Order::where('customer_id', $customerId)->sum('total_harga_akhir');
        $totalAktif = Order::where('customer_id', $customerId)
            ->whereIn('status', ['pending', 'proses', 'dikirim'])
            ->count();

        // Query pesanan
        $ordersQuery = Order::where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->with('orderItems');

        // Terapkan filter status
        if ($status) {
            $ordersQuery->where('status', $status);
        } elseif ($showAll !== 'all') {
            // Default: Sembunyikan yang batal jika tidak ada filter & bukan 'lihat semua'
            $ordersQuery->where('status', '!=', 'cancelled');
        }
        // Jika showAll='all' dan status kosong, tidak ada filter status (tampilkan semua)

        // Handle pagination
        if ($showAll == 'all') {
            $total = $ordersQuery->count();
            $orders = $ordersQuery->paginate($total > 0 ? $total : 1);
        } else {
            $orders = $ordersQuery->paginate(5);
        }


        return view('frontend.pesanan', compact(
            'orders',
            'totalPesanan',
            'totalBelanja',
            'totalAktif',
            'status',
            'showAll'
        ));
    }

    public function selesai($id)
    {
        $order = Order::where('id', $id)
            ->where('customer_id', Auth::guard('customer')->id())
            ->firstOrFail();

        // hanya boleh selesai jika status = dikirim
        if ($order->status !== 'dikirim') {
            return back()->with('error', 'Pesanan belum dalam status dikirim.');
        }

        $order->update([
            'status' => 'selesai',
        ]);

        return back()->with('success', 'Pesanan berhasil diselesaikan.');
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('customer_id', Auth::guard('customer')->id())
            ->firstOrFail();

        // Hanya boleh dibatalkan jika status 'pending' atau 'proses'
        if (!in_array($order->status, ['pending', 'proses'])) {
            return back()->with('error', 'Pesanan ini tidak dapat dibatalkan pada tahap ini.');
        }

        // Ubah status order menjadi 'cancelled'
        $order->update(['status' => 'cancelled']);

        // Ubah juga status payment jika ada
        if ($order->payment) {
            $order->payment->update(['pembayaran_status' => 'cancelled']);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('customer.dashboard')->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
