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
        $orders = Order::with('customers', 'produks')
            ->when($search, function ($query, $search) {
                return $query->where('id', 'like', "%{$search}%")
                    ->orWhereHas('customers', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('produks', function ($q) use ($search) {
                        $q->where('nama_produk', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.backend.order.list_order', compact('orders', 'search'));
    }
}
