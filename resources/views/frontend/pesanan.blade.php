@extends('frontend.layouts.app')

@section('content')
<!-- Latar belakang gradien yang lembut -->
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30 pt-20 pb-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

        <!-- Header Section dengan Card -->
        <div class="mb-8 animate-fade-in-down">
            <div class="bg-gradient-to-r from-sage-600 to-sage-700 rounded-3xl p-8 shadow-xl relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white rounded-full translate-y-1/2 -translate-x-1/2"></div>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-bold text-white font-playfair mb-2">Akun Saya</h1>
                            <p class="text-sage-100 text-lg">
                                Selamat datang kembali, <span class="font-semibold text-white">{{ Auth::guard('customer')->user()->nama_lengkap }}!</span>
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Total Pesanan</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">2</p>
                    </div>
                    <div class="bg-blue-100 rounded-2xl p-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Total Belanja</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">Rp 700K</p>
                    </div>
                    <div class="bg-green-100 rounded-2xl p-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Pesanan Aktif</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">1</p>
                    </div>
                    <div class="bg-orange-100 rounded-2xl p-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesanan Section -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden animate-fade-in-up" style="animation-delay: 0.2s;">
            <!-- Header -->
            <div class="bg-gradient-to-r from-slate-50 to-white px-8 py-6 border-b border-slate-200">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 font-playfair">Pesanan Terbaru</h3>
                        <p class="text-slate-500 mt-1">Kelola dan lacak pesanan Anda</p>
                    </div>
                    <div class="flex space-x-3">
                        <button class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-medium transition-colors duration-200 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span>Filter</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pesanan Cards (Mobile Optimized) -->
            <div class="p-6 sm:p-8 space-y-4">
                <!-- Pesanan Item 1 -->
                <div class="group bg-gradient-to-br from-white to-slate-50 rounded-2xl border-2 border-slate-100 hover:border-sage-300 p-6 transition-all duration-300 hover:shadow-lg animate-slide-in" style="animation-delay: 0.3s;">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                        <!-- Left Section -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-sage-100 rounded-xl p-3 group-hover:bg-sage-200 transition-colors duration-300">
                                <svg class="w-6 h-6 text-sage-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center space-x-3 mb-2">
                                    <h4 class="text-lg font-bold text-slate-900">#12345</h4>
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide">Selesai</span>
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-slate-500">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>15 Okt 2025</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        <span>3 item</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="flex items-center justify-between lg:justify-end gap-4 lg:space-x-6">
                            <div class="text-right">
                                <p class="text-sm text-slate-500 mb-1">Total Pembayaran</p>
                                <p class="text-2xl font-bold text-slate-900">Rp 450.000</p>
                            </div>
                            <button class="px-5 py-2.5 bg-sage-600 hover:bg-sage-700 text-white rounded-xl font-medium transition-all duration-200 hover:shadow-lg hover:scale-105 flex items-center space-x-2">
                                <span>Detail</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pesanan Item 2 -->
                <div class="group bg-gradient-to-br from-white to-slate-50 rounded-2xl border-2 border-slate-100 hover:border-blue-300 p-6 transition-all duration-300 hover:shadow-lg animate-slide-in" style="animation-delay: 0.4s;">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                        <!-- Left Section -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-100 rounded-xl p-3 group-hover:bg-blue-200 transition-colors duration-300">
                                <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center space-x-3 mb-2">
                                    <h4 class="text-lg font-bold text-slate-900">#12344</h4>
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide flex items-center space-x-1">
                                        <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                                        <span>Dikirim</span>
                                    </span>
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-slate-500">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>12 Okt 2025</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        <span>2 item</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="flex items-center justify-between lg:justify-end gap-4 lg:space-x-6">
                            <div class="text-right">
                                <p class="text-sm text-slate-500 mb-1">Total Pembayaran</p>
                                <p class="text-2xl font-bold text-slate-900">Rp 250.000</p>
                            </div>
                            <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition-all duration-200 hover:shadow-lg hover:scale-105 flex items-center space-x-2">
                                <span>Lacak</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gradient-to-r from-slate-50 to-white px-8 py-6 border-t border-slate-200">
                <div class="flex items-center justify-between">
                    <p class="text-slate-500">Menampilkan 2 dari 2 pesanan</p>
                    <a href="#" class="group flex items-center space-x-2 text-sage-600 font-semibold hover:text-sage-700 transition-colors duration-200">
                        <span>Lihat semua pesanan</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Animasi -->
<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fade-in-up {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes slide-in {
        0% { opacity: 0; transform: translateX(-20px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    @keyframes pulse-slow {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .animate-fade-in-down {
        animation: fade-in-down 0.6s ease-out both;
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out both;
    }

    .animate-slide-in {
        animation: slide-in 0.5s ease-out both;
    }

    .animate-pulse {
        animation: pulse-slow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>
@endsection
