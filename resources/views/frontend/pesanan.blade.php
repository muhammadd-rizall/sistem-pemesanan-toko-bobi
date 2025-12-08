@extends('frontend.layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30 pt-20 pb-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

            <!-- Header -->
            <div class="mb-8 animate-fade-in-down">
                <div class="bg-gradient-to-r from-sage-600 to-sage-700 rounded-3xl p-8 shadow-xl relative overflow-hidden">

                    <!-- background pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full -translate-y-1/2 translate-x-1/2">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-48 h-48 bg-white rounded-full translate-y-1/2 -translate-x-1/2">
                        </div>
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between flex-wrap gap-4">

                            <div>
                                <h1 class="text-4xl md:text-5xl font-bold text-white font-playfair mb-2">Akun Saya</h1>
                                <p class="text-sage-100 text-lg">
                                    Selamat datang kembali,
                                    <span class="font-semibold text-white">
                                        {{ Auth::guard('customer')->user()->name }}!
                                    </span>
                                </p>
                            </div>

                            <div class="flex items-center space-x-3">
                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-fade-in-up" style="animation-delay: .1s">

                <!-- Total Pesanan -->
                <div
                    class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Total Pesanan</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalPesanan }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-2xl p-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Belanja -->
                <div
                    class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Total Belanja</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">
                                Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-green-100 rounded-2xl p-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pesanan Aktif -->
                <div
                    class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Pesanan Aktif</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalAktif }}</p>
                        </div>
                        <div class="bg-orange-100 rounded-2xl p-4">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Pesanan -->
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden animate-fade-in-up"
                style="animation-delay:.2s">

                <!-- Header -->
                <div class="bg-gradient-to-r from-slate-50 to-white px-8 py-6 border-b border-slate-200">

                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 font-playfair">Pesanan Terbaru</h3>
                            <p class="text-slate-500 mt-1">Kelola pesanan Anda</p>
                        </div>

                        <!-- FILTER STATUS HORIZONTAL -->
                        <div class="w-full overflow-x-auto">
                            <div class="flex items-center space-x-3">

                                @php
                                    $filters = [
                                        '' => 'Semua',
                                        'pending' => 'Pending',
                                        'proses' => 'Proses',
                                        'dikirim' => 'Dikirim',
                                        'selesai' => 'Selesai',
                                        'cancelled' => 'Batal',
                                    ];
                                @endphp

                                <div class="w-full overflow-x-auto">
                                    <div class="flex items-center justify-center space-x-3">
                                        @php
                                            $filters = [
                                                '' => 'Semua',
                                                'pending' => 'Pending',
                                                'proses' => 'Proses',
                                                'dikirim' => 'Dikirim',
                                                'selesai' => 'Selesai',
                                                'cancelled' => 'Batal',
                                            ];
                                        @endphp

        
                                        @foreach ($filters as $key => $label)
                                            <a href="{{ request()->fullUrlWithQuery(['status' => $key]) }}"
                                                class="px-4 py-2 rounded-xl text-sm font-semibold whitespace-nowrap border transition-all duration-200
           @if ($status == $key) bg-sage-600 text-white border-sage-600 shadow
           @else bg-slate-100 text-slate-600 border-slate-200 hover:bg-slate-200 @endif">
                                                {{ $label }}
                                            </a>
                                        @endforeach
                                    </div>


                                </div>


                            </div>
                        </div>

                    </div>

                </div>

                <!-- Pesanan list -->
                <div class="p-6 sm:p-8 space-y-4">

                    @forelse ($orders as $order)
                        <div
                            class="group bg-gradient-to-br from-white to-slate-50 rounded-2xl border-2
                            @if ($order->status == 'selesai') hover:border-sage-300 @endif
                            @if ($order->status == 'dikirim') hover:border-blue-300 @endif
                            p-6 transition-all duration-300 hover:shadow-lg animate-slide-in">

                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">

                                <!-- Left -->
                                <div class="flex items-start space-x-4">

                                    <!-- icon -->
                                    <div
                                        class="
                                        @if ($order->status == 'selesai') bg-sage-100 group-hover:bg-sage-200 @endif
                                        @if ($order->status == 'dikirim') bg-blue-100 group-hover:bg-blue-200 @endif
                                        rounded-xl p-3 transition-colors duration-300">

                                        <svg class="w-6 h-6
                                            @if ($order->status == 'selesai') text-sage-700 @endif
                                            @if ($order->status == 'dikirim') text-blue-700 @endif"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>

                                    <!-- info pesanan -->
                                    <div>

                                        <div class="flex items-center space-x-3 mb-2">
                                            <h4 class="text-lg font-bold text-slate-900">
                                                #{{ $order->invoice_number }}
                                            </h4>

                                            <!-- badge -->
                                            @if ($order->status == 'selesai')
                                                <span
                                                    class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold uppercase">
                                                    Selesai
                                                </span>
                                            @elseif ($order->status == 'dikirim')
                                                <span
                                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold uppercase flex items-center space-x-1">
                                                    <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                                                    <span>Dikirim</span>
                                                </span>
                                            @elseif ($order->status == 'pending')
                                                <span
                                                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold uppercase">Pending</span>
                                            @elseif ($order->status == 'proses')
                                                <span
                                                    class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold uppercase">Proses</span>
                                            @elseif ($order->status == 'cancelled')
                                                <span
                                                    class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold uppercase">Cancelled</span>
                                            @endif
                                        </div>

                                        <!-- tanggal & jumlah item -->
                                        <div class="flex items-center space-x-4 text-sm text-slate-500">

                                            <div class="flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>{{ $order->created_at->format('d M Y') }}</span>
                                            </div>

                                            <div class="flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                                <span>{{ $order->orderItems->count() }} item</span>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <!-- Right -->
                                <div class="flex items-center justify-between lg:justify-end gap-4">

                                    <div class="text-right">
                                        <p class="text-sm text-slate-500 mb-1">Total Pembayaran</p>
                                        <p class="text-2xl font-bold text-slate-900">
                                            Rp {{ number_format($order->total_harga_akhir, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        @if ($order->status == 'pending')
                                            <a href="{{ route('customer.orders.preview.show', ['order' => $order->id, 'action' => 'view']) }}"
                                                class="px-5 py-2.5 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-medium transition-all hover:scale-105 flex items-center space-x-2">
                                                <span>Detail</span>
                                            </a>
                                            <a href="{{ route('customer.orders.preview.show', $order->id) }}"
                                                class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-all hover:scale-105 flex items-center space-x-2">
                                                <span>Bayar</span>
                                            </a>
                                        @elseif ($order->status == 'dikirim')
                                            <a href="{{ route('customer.orders.preview.show', ['order' => $order->id, 'action' => 'view']) }}"
                                                class="px-5 py-2.5 bg-sage-600 hover:bg-sage-700 text-white rounded-xl font-medium transition-all hover:scale-105 flex items-center space-x-2">
                                                <span>Detail</span>
                                            </a>
                                            <form action="{{ route('customer.selesai', $order->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah pesanan ini sudah diterima dan selesai?')">
                                                @csrf
                                                <button type="submit"
                                                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition-all hover:scale-105 flex items-center space-x-2">
                                                    <span>Selesai</span>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('customer.orders.preview.show', ['order' => $order->id, 'action' => 'view']) }}"
                                                class="px-5 py-2.5 bg-sage-600 hover:bg-sage-700 text-white rounded-xl font-medium transition-all hover:scale-105 flex items-center space-x-2">
                                                <span>Detail</span>
                                            </a>
                                        @endif
                                    </div>

                                </div>

                            </div>

                        </div>

                    @empty
                        <p class="text-center text-slate-500">Tidak ada pesanan ditemukan.</p>
                    @endforelse

                </div>

                <!-- Footer -->
                <div class="bg-gradient-to-r from-slate-50 to-white px-8 py-6 border-t border-slate-200">
                    <div class="flex items-center justify-between">
                        <p class="text-slate-500">Menampilkan {{ $orders->count() }} dari {{ $orders->total() }} pesanan
                        </p>
                        <a href="{{ route('customer.dashboard', ['show' => 'all']) }}"
                            class="group flex items-center space-x-2 text-sage-600 font-semibold hover:text-sage-700 transition-colors">
                            <span>Lihat semua pesanan</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
