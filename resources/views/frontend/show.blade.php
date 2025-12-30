@extends('frontend.layouts.app')

@section('content')
    <div class="min-h-screen bg-sage-50/30">

        <div class="border-b border-sage-100 bg-white">
            <div class="container mx-auto px-4 py-4 sm:px-6 lg:px-8">
                <nav class="flex text-sm font-medium text-sage-500">
                    <a href="{{ route('home') }}" class="hover:text-sage-900 transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('produk') }}" class="hover:text-sage-900 transition-colors">Produk</a>
                    <span class="mx-2">/</span>
                    <span class="text-sage-800">{{ $product->nama_produk }}</span>
                </nav>
            </div>
        </div>

        <div class="container mx-auto px-4 py-10 sm:px-6 lg:px-8 max-w-6xl">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start mb-20 animate-fade-in-up">

                <div class="lg:sticky lg:top-28 group">
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl shadow-sage-200/50 border border-sage-100 bg-white aspect-square">
                        {{-- Badge Category --}}
                        <div class="absolute top-4 left-4 z-10">
                            <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-sage-800 text-xs font-bold uppercase tracking-wider rounded-full shadow-sm border border-sage-100">
                                {{ $product->category->name ?? 'Collection' }}
                            </span>
                        </div>

                        <img src="{{ $product->gambar_produk ? asset('storage/' . $product->gambar_produk) : asset('storage/products/default.png') }}"
                            alt="{{ $product->nama_produk }}"
                            class="w-full h-full object-cover object-center transform transition-transform duration-700 group-hover:scale-105">

                        {{-- Overlay Gradient --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                </div>

                <div class="flex flex-col h-full justify-center">

                    <div class="mb-8 border-b border-sage-100 pb-8">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-sage-500 text-sm font-medium tracking-wide uppercase">{{ $product->merek }}</span>
                            <span class="w-1 h-1 bg-sage-300 rounded-full"></span>
                            <span class="text-sage-500 text-sm font-medium {{ $product->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stok > 0 ? 'Stok Tersedia (' . $product->stok . ')' : 'Stok Habis' }}
                            </span>

                            {{-- Rating Singkat di Atas --}}
                            @if($totalReviews > 0)
                                <span class="w-1 h-1 bg-sage-300 rounded-full"></span>
                                <div class="flex items-center gap-1 text-yellow-500 text-sm">
                                    <i class="fas fa-star"></i>
                                    <span class="text-sage-600 font-bold">{{ number_format($averageRating, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <h1 class="text-4xl md:text-5xl font-bold text-sage-900 font-serif leading-tight mb-4">
                            {{ $product->nama_produk }}
                        </h1>

                        <div class="flex items-end gap-3">
                            <p class="text-3xl md:text-4xl font-bold text-sage-800">
                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-sage-900 uppercase tracking-wider mb-3">Deskripsi Produk</h3>
                        <div class="prose prose-sage text-sage-600 leading-relaxed">
                            <p>{{ $product->deskripsi }}</p>
                        </div>
                    </div>

                    <div class="bg-sage-50 rounded-xl p-4 border border-sage-100 mb-8 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-sage-600 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-sage-500 uppercase font-bold">Disuplai Oleh</p>
                            <p class="text-sm font-semibold text-sage-900">{{ $product->supplier->nama_perusahaan ?? 'Official Store' }}</p>
                        </div>
                    </div>

                    <div class="mt-auto">
                        @if (Auth::guard('customer')->check())
                            @if ($product->stok > 0)
                                <a href="{{ route('customer.orders.create', ['product' => $product->id]) }}"
                                   class="group relative w-full flex items-center justify-center gap-3 bg-sage-800 text-white font-bold text-lg py-4 px-8 rounded-xl overflow-hidden shadow-xl shadow-sage-200 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                                    <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-sage-700 to-sage-900 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                                    <span class="relative flex items-center gap-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        Pesan Sekarang
                                    </span>
                                </a>
                            @else
                                <button disabled class="w-full bg-gray-200 text-gray-400 font-bold text-lg py-4 px-8 rounded-xl cursor-not-allowed flex items-center justify-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                    Stok Habis
                                </button>
                            @endif
                        @else
                            <button onclick="openModal('loginModal')"
                                    class="group w-full flex items-center justify-center gap-3 bg-sage-600 text-white font-bold text-lg py-4 px-8 rounded-xl shadow-lg hover:bg-sage-700 transition-all duration-300 hover:-translate-y-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                Masuk untuk Pesan
                            </button>
                        @endif

                        <div class="mt-6 flex items-center justify-center gap-6 text-sm text-sage-500">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Original Product</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Secure Payment</span>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="border-sage-200 mb-16">

            <div class="mb-24">
                <div class="flex items-center justify-between mb-10">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                        <h2 class="text-3xl font-bold text-sage-900 font-serif">Ulasan Pelanggan</h2>
                        @if($totalReviews > 0)
                            <div class="flex items-center gap-2 bg-white px-4 py-1.5 rounded-full border border-sage-200 shadow-sm">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <span class="ml-2 text-sage-800 font-bold">{{ number_format($averageRating, 1) }}</span>
                                </div>
                                <span class="text-sage-400 text-sm">|</span>
                                <span class="text-sage-500 text-sm">{{ $totalReviews }} Ulasan</span>
                            </div>
                        @endif
                    </div>

                    {{-- Tombol Lihat Semua (Desktop) --}}
                    @if($totalReviews > 3)
                        <a href="{{ route('product.reviews', $product->id) }}" class="hidden sm:inline-flex items-center gap-2 text-sage-600 font-semibold hover:text-sage-900 transition-colors group">
                            Lihat Semua <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    @endif
                </div>

                {{-- Grid Review: Ubah layout jadi 3 kolom jika ada 3 review --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($product->reviews->take(3) as $review)
                        <div class="bg-white p-6 rounded-3xl border border-sage-100 shadow-sm hover:shadow-lg hover:border-sage-200 transition-all duration-300 flex flex-col h-full">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full p-0.5 bg-gradient-to-tr from-sage-200 to-sage-400 flex-shrink-0">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($review->customer->name ?? 'User') }}&background=f0fdf4&color=166534"
                                             class="w-full h-full rounded-full object-cover bg-white"
                                             alt="Avatar">
                                    </div>
                                    <div>
                                        <p class="font-bold text-sage-900 text-sm line-clamp-1">{{ $review->customer->name ?? 'Pengguna' }}</p>
                                        <p class="text-xs text-sage-400 font-medium">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex text-yellow-400 text-xs bg-yellow-50 px-2 py-1 rounded-md">
                                    <i class="fas fa-star"></i>
                                    <span class="ml-1 font-bold text-yellow-600">{{ $review->rating }}</span>
                                </div>
                            </div>
                            <div class="relative pl-4 border-l-2 border-sage-200 flex-1">
                                <p class="text-sage-700 text-sm leading-relaxed italic line-clamp-3">
                                    "{{ $review->comment }}"
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 bg-sage-50 rounded-3xl border border-dashed border-sage-300 flex flex-col items-center justify-center text-center">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm">
                                <svg class="w-8 h-8 text-sage-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            </div>
                            <p class="text-sage-800 font-semibold text-lg">Belum ada ulasan</p>
                            <p class="text-sage-500 text-sm">Jadilah yang pertama mengulas produk ini!</p>
                        </div>
                    @endforelse
                </div>

                {{-- Tombol Lihat Semua (Mobile) --}}
                @if($totalReviews > 3)
                    <div class="mt-8 text-center sm:hidden">
                        <a href="{{ route('product.reviews', $product->id) }}" class="w-full inline-flex justify-center items-center gap-2 text-sage-700 font-bold hover:bg-sage-100 transition-colors border border-sage-200 px-6 py-3 rounded-xl">
                            Lihat Semua ({{ $totalReviews }})
                        </a>
                    </div>
                @endif
            </div>

            <div class="relative">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-sage-900 font-serif">Mungkin Anda Suka</h2>

                    <div class="hidden md:flex gap-2">
                        <button class="w-8 h-8 rounded-full border border-sage-200 flex items-center justify-center text-sage-500 hover:bg-sage-50 transition-colors" onclick="document.getElementById('rec-container').scrollBy({left: -300, behavior: 'smooth'})">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button class="w-8 h-8 rounded-full border border-sage-200 flex items-center justify-center text-sage-500 hover:bg-sage-50 transition-colors" onclick="document.getElementById('rec-container').scrollBy({left: 300, behavior: 'smooth'})">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>

                <div id="rec-container" class="flex overflow-x-auto gap-3 pb-6 snap-x snap-mandatory scrollbar-hide px-1" style="scrollbar-width: none; -ms-overflow-style: none;">

                    @foreach($relatedProducts as $related)
                        <div class="min-w-[10rem] md:min-w-[12rem] snap-start">
                            <a href="{{ route('products.show', $related->id) }}" class="block group h-full">
                                <div class="bg-white rounded-lg border border-sage-100 overflow-hidden shadow-sm hover:shadow-md hover:border-sage-200 transition-all duration-300 h-full flex flex-col">

                                    <div class="relative h-32 bg-sage-50 overflow-hidden">
                                        <img src="{{ $related->gambar_produk ? asset('storage/' . $related->gambar_produk) : asset('storage/products/default.png') }}"
                                             alt="{{ $related->nama_produk }}"
                                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                    </div>

                                    <div class="p-2.5 flex-1 flex flex-col">
                                        <p class="text-sage-400 text-[10px] font-bold uppercase tracking-wider mb-0.5 truncate">{{ $related->category->name ?? 'Produk' }}</p>

                                        {{-- Judul lebih kecil (text-xs) --}}
                                        <h3 class="font-bold text-sage-900 text-xs leading-snug line-clamp-2 mb-2 group-hover:text-sage-700 transition-colors h-8">
                                            {{ $related->nama_produk }}
                                        </h3>

                                        <div class="mt-auto pt-2 border-t border-sage-50 flex justify-between items-center">
                                            {{-- Harga lebih kecil --}}
                                            <span class="font-bold text-sage-800 text-xs">Rp {{ number_format($related->harga_jual, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div class="min-w-[6rem] snap-start flex items-center justify-center">
                        <a href="{{ route('produk') }}" class="flex flex-col items-center gap-1.5 text-sage-500 hover:text-sage-800 transition-colors group p-2">
                            <div class="w-10 h-10 rounded-full border border-sage-200 flex items-center justify-center group-hover:border-sage-400 group-hover:bg-sage-50 transition-all bg-white shadow-sm">
                                <svg class="w-4 h-4 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-center uppercase tracking-wide">Lihat<br>Semua</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
    {{-- Script untuk menghilangkan scrollbar default tapi tetap bisa scroll --}}
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
