<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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

    public function showOrder($id)
    {
        $order = Order::with('customer', 'diskon', 'orderItems.produk')->findOrFail($id);
        return view('admin.backend.order.show_order', compact('order'));
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->orderItems()->delete(); // Hapus item order terkait
        $order->delete();

        return redirect()->route('listOrder')->with('success', 'Order berhasil dihapus.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,dikirim,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }
}
