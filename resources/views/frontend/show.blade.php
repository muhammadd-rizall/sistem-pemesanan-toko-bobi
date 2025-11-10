@extends('frontend.layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-12 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <!-- Product Image -->
            <div class="sticky top-24">
                <div class="overflow-hidden rounded-2xl shadow-lg bg-gray-50">
                    <img src="{{ $product->gambar_produk ? asset('storage/' . $product->gambar_produk) : asset('storage/products/default.png') }}"
                        alt="{{ $product->nama_produk }}"
                        class="w-full h-auto object-cover transform hover:scale-110 transition-transform duration-700 ease-out">
                </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-8">
                <!-- Title & Price -->
                <div class="border-b border-gray-200 pb-6">
                    <h1 class="text-5xl font-bold text-slate-green mb-4 leading-tight">{{ $product->nama_produk }}</h1>
                    <div class="flex items-baseline gap-3">
                        <p class="text-4xl font-semibold text-sage">
                            {{ 'Rp ' . number_format($product->harga_jual, 0, ',', '.') }}</p>
                        <span class="text-sm text-gray-500 uppercase tracking-wide">IDR</span>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-700 mb-3">Description</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">{{ $product->deskripsi }}</p>
                </div>

                {{-- <!-- Size Selection -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-700 mb-4">Select Size</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($product->sizes as $size)
                            <button
                                class="px-6 py-3 border-2 border-gray-300 rounded-lg text-sm font-medium hover:border-[#7eb17e] hover:bg-[#7eb17e] hover:text-white transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#7eb17e] focus:ring-offset-2 transform hover:scale-105">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div> --}}

                <!-- Stock & Order Button -->
                <div class="pt-6 space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full {{ $product->stok > 0 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                        <span class="text-sm font-medium {{ $product->stok > 0 ? 'text-green-700' : 'text-red-700' }}">
                            {{ $product->stok > 0 ? 'In Stock (' . $product->stok . ' available)' : 'Out of Stock' }}
                        </span>
                    </div>

                    @if (Auth::guard('customer')->check())
                        {{-- User sudah login sebagai customer --}}
                        @if ($product->stok > 0)
                            <a href="{{ route('customer.formPemesanan', ['id' => $product->id]) }}">
                                <button
                                    class="w-full bg-[#7eb17e] text-white font-bold text-lg py-4 px-8 rounded-xl hover:bg-[#6da16d] transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#7eb17e] focus:ring-opacity-50">
                                    <span class="flex items-center justify-center gap-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        Pesan Sekarang
                                    </span>
                                </button>
                            </a>
                        @else
                            <button
                                class="w-full bg-gray-400 text-white font-bold text-lg py-4 px-8 rounded-xl cursor-not-allowed opacity-60"
                                disabled>
                                <span class="flex items-center justify-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Stok Habis
                                </span>
                            </button>
                        @endif
                    @else
                        {{-- User belum login --}}
                        <button type="button" onclick="openModal('loginModal')"
                            class="w-full flex items-center justify-center gap-3 bg-[#7eb17e] text-white font-bold text-lg py-4 px-8 rounded-xl hover:bg-[#6da16d] transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#7eb17e] focus:ring-opacity-50">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Masuk untuk Pesan
                        </button>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection


