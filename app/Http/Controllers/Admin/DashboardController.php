<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Customers
        $totalCustomers = Customer::count();
        $lastMonthCustomers = Customer::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        $customerGrowth = $lastMonthCustomers > 0
            ? (($totalCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100
            : 0;

        // Total Orders
        $totalOrders = Order::count();
        $lastMonthOrders = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        $orderGrowth = $lastMonthOrders > 0
            ? (($totalOrders - $lastMonthOrders) / $lastMonthOrders) * 100
            : 0;

        // Total Revenue
        $totalRevenue = Order::whereIn('status', ['selesai', 'dikirim', 'proses'])
            ->sum('total_harga_akhir');
        $lastMonthRevenue = Order::whereIn('status', ['selesai', 'dikirim', 'proses'])
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total_harga_akhir');
        $revenueGrowth = $lastMonthRevenue > 0
            ? (($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 0;

        // Total Products
        $totalProducts = Produk::count();
        $lastMonthProducts = Produk::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        $productGrowth = $lastMonthProducts > 0
            ? (($totalProducts - $lastMonthProducts) / $lastMonthProducts) * 100
            : 0;

        // Chart Data - 12 Bulan Terakhir untuk Pesanan
        $orderChartData = [];
        $orderChartLabels = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $orderChartLabels[] = $date->locale('id')->isoFormat('MMM Y');
            $orderChartData[] = Order::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

        // Chart Data - 12 Bulan Terakhir untuk Pendapatan
        $revenueChartData = [];
        $revenueChartLabels = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $revenueChartLabels[] = $date->locale('id')->isoFormat('MMM Y');
            $revenueChartData[] = Order::whereIn('status', ['selesai', 'dikirim', 'proses'])
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_harga_akhir');
        }

        // Recent Orders
        $recentOrders = Order::with('customer')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'totalCustomers',
            'customerGrowth',
            'totalOrders',
            'orderGrowth',
            'totalRevenue',
            'revenueGrowth',
            'totalProducts',
            'productGrowth',
            'orderChartData',
            'orderChartLabels',
            'revenueChartData',
            'revenueChartLabels',
            'recentOrders'
        ));
    }
}
