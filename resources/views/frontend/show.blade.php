@extends('frontend.layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-12 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
            <!-- Product Image -->
            {{-- Bagian gambar sticky tetap sama --}}
            <div class="sticky top-28">
                <div class="overflow-hidden rounded-2xl shadow-xl bg-gray-50 border border-sage-200">
                    <img src="{{ $product->gambar_produk ? asset('storage/' . $product->gambar_produk) : asset('storage/products/default.png') }}"
                        alt="{{ $product->nama_produk }}"
                        class="w-full h-auto object-cover aspect-square"> {{-- Tambah aspect-square --}}
                </div>
            </div>

            <!-- Product Details -->
            {{-- UBAH TOTAL BAGIAN Product Details (Poin 5) --}}
            <div class="space-y-6">

                <div class="text-sm font-semibold text-sage-600 uppercase tracking-wider">
                    {{ $product->category->name ?? 'Tidak Berkategori' }}
                </div>

                <h1 class="text-4xl lg:text-5xl font-bold text-sage-900 leading-tight">{{ $product->nama_produk }}</h1>

                <div class="flex items-baseline gap-3">
                    <p class="text-4xl font-bold text-sage-800">
                        {{ 'Rp ' . number_format($product->harga_jual, 0, ',', '.') }}
                    </p>
                    <span class="text-sm text-gray-500 uppercase tracking-wide">IDR</span>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-sage-200">
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-sage-700 mb-1">Merek</h4>
                        <p class="text-lg font-medium text-sage-900">{{ $product->merek }}</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-sage-700 mb-1">Supplier</h4>
                        <p class="text-lg font-medium text-sage-900">{{ $product->supplier->nama_perusahaan ?? 'Bobi Ceramic\'s' }}</p>
                    </div>
                </div>

                <div class="pt-4 border-t border-sage-200">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-sage-700 mb-3">Deskripsi Produk</h3>
                    <p class="text-gray-700 leading-relaxed text-base">{{ $product->deskripsi }}</p>
                </div>

                <div class="pt-6 space-y-4">
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-3 h-3 rounded-full {{ $product->stok > 0 ? 'bg-green-500' : 'bg-red-500' }} animate-pulse">
                            </div>
                            <span class="text-sm font-medium {{ $product->stok > 0 ? 'text-green-700' : 'text-red-700' }}">
                                {{ $product->stok > 0 ? 'Stok Tersedia (' . $product->stok . ' Pcs)' : 'Stok Habis' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-sm font-medium text-sage-700 capitalize">
                                Status: {{ $product->status }}
                            </span>
                        </div>
                    </div>

                    @if (Auth::guard('customer')->check())
                        {{-- User sudah login sebagai customer --}}
                        @if ($product->stok > 0)
                            <a href="{{ route('customer.formPemesanan', ['id' => $product->id]) }}">
                                <button
                                    class="w-full bg-sage-600 text-white font-bold text-lg py-4 px-8 rounded-xl hover:bg-sage-700 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-sage-400 focus:ring-opacity-50">
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
                            class="w-full flex items-center justify-center gap-3 bg-sage-600 text-white font-bold text-lg py-4 px-8 rounded-xl hover:bg-sage-700 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-sage-400 focus:ring-opacity-50">
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
            {{-- AKHIR PERUBAHAN Product Details --}}
        </div>
    </div>
@endsection


