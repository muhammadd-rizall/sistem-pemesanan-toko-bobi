@extends('admin.layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-sage-800">Dashboard</h1>
        <p class="text-sage-600 mt-1">Selamat datang kembali, Admin! Berikut ringkasan aktivitas toko Anda.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
            class="bg-white p-6 rounded-xl shadow-md transform hover:-translate-y-1 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-start">
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Total Customer</p>
                    <p class="text-3xl font-bold text-sage-800 mt-1">{{ $totalCustomers }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-green-500 mt-4 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span>{{ number_format($customerGrowth, 1) }}%</span>
                <span class="text-gray-400 ml-1">dari bulan lalu</span>
            </p>
        </div>

        <div
            class="bg-white p-6 rounded-xl shadow-md transform hover:-translate-y-1 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-start">
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Total Pesanan</p>
                    <p class="text-3xl font-bold text-sage-800 mt-1">{{ $totalOrders }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-green-500 mt-4 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span>{{ number_format($orderGrowth, 1) }}%</span>
                <span class="text-gray-400 ml-1">dari bulan lalu</span>
            </p>
        </div>

        <div
            class="bg-white p-6 rounded-xl shadow-md transform hover:-translate-y-1 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-start">
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                    <p class="text-3xl font-bold text-sage-800 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="bg-sage-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-green-500 mt-4 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span>{{ number_format($revenueGrowth, 1) }}%</span>
                <span class="text-gray-400 ml-1">dari bulan lalu</span>
            </p>
        </div>

        <div
            class="bg-white p-6 rounded-xl shadow-md transform hover:-translate-y-1 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-start">
                <div class="flex flex-col">
                    <p class="text-sm font-medium text-gray-500">Total Produk</p>
                    <p class="text-3xl font-bold text-sage-800 mt-1">{{ $totalProducts }}</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-green-500 mt-4 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span>{{ number_format($productGrowth, 1) }}%</span>
                <span class="text-gray-400 ml-1">dari bulan lalu</span>
            </p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-10">
        <!-- Chart Total Pesanan (12 Bulan) -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-bold text-sage-800 mb-4">Total Pesanan (12 Bulan Terakhir)</h2>
            <div style="height: 250px;">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        <!-- Chart Total Pendapatan (12 Bulan) -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-bold text-sage-800 mb-4">Total Pendapatan (12 Bulan Terakhir)</h2>
            <div style="height: 250px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <div class="mt-10 bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold text-sage-800 mb-4">Pesanan Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-sm font-semibold text-gray-500 border-b-2 border-sage-100">
                        <th class="py-2 px-2 sm:py-3 sm:px-4">ID Pesanan</th>
                        <th class="py-2 px-2 sm:py-3 sm:px-4">Pelanggan</th>
                        <th class="py-2 px-2 sm:py-3 sm:px-4">Tanggal</th>
                        <th class="py-2 px-2 sm:py-3 sm:px-4">Total</th>
                        <th class="py-2 px-2 sm:py-3 sm:px-4 text-center">Status</th>
                        <th class="py-2 px-2 sm:py-3 sm:px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($recentOrders as $order)
                        <tr class="border-b border-sage-100 hover:bg-sage-50 transition-colors">
                            <td class="py-3 px-2 sm:py-4 sm:px-4 font-medium">#{{ $order->invoice_number }}</td>
                            <td class="py-3 px-2 sm:py-4 sm:px-4">{{ $order->customer->name }}</td>
                            <td class="py-3 px-2 sm:py-4 sm:px-4">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-2 sm:py-4 sm:px-4 font-semibold">Rp
                                {{ number_format($order->total_harga_akhir, 0, ',', '.') }}</td>
                            <td class="py-3 px-2 sm:py-4 sm:px-4 text-center">
                                @if ($order->status == 'selesai')
                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Selesai</span>
                                @elseif($order->status == 'dikirim')
                                    <span
                                        class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">Dikirim</span>
                                @elseif($order->status == 'proses')
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">Diproses</span>
                                @elseif($order->status == 'cancelled')
                                    <span
                                        class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">Dibatalkan</span>
                                @else
                                    <span
                                        class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">Pending</span>
                                @endif
                            </td>
                            <td class="py-3 px-2 sm:py-4 sm:px-4 text-center">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('detailOrder', $order->id) }}"
                                        class="p-2 text-yellow-600 hover:bg-yellow-100 rounded-full transition-colors duration-200"
                                        title="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500">Belum ada penjualan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Total Pesanan
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($orderChartLabels) !!},
                datasets: [{
                    label: 'Total Pesanan',
                    data: {!! json_encode($orderChartData) !!},
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(99, 102, 241, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => 'Pesanan: ' + context.parsed.y
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Chart Total Pendapatan
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($revenueChartLabels) !!},
                datasets: [{
                    label: 'Pendapatan',
                    data: {!! json_encode($revenueChartData) !!},
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1,
                    borderRadius: 6,
                    barPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: (value) => 'Rp ' + (value / 1000000).toFixed(1) + 'jt'
                        }
                    }
                }
            }
        });
    </script>
@endpush
