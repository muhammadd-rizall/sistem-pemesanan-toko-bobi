@extends('frontend.layouts.app')

@section('content')
<div class="bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <!-- Header Halaman -->
        <div class="text-center mb-12 animate-fade-in-down">
            <h1 class="text-4xl sm:text-5xl font-bold text-sage-900">Koleksi Produk Kami</h1>
            <p class="mt-4 text-lg text-sage-600 max-w-2xl mx-auto">Temukan keramik berkualitas tinggi dengan berbagai motif dan ukuran untuk setiap kebutuhan ruangan Anda.</p>
        </div>

        <!-- Filter dan Search -->
            <!-- Filter dan Search -->
<form action="{{ route('produk') }}" method="GET" class="animate-fade-in">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-12">
        <!-- 1. Input Search -->
        <div class="relative w-full md:w-1/3">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari produk..."
                   class="w-full pl-10 pr-4 py-3 border-2 border-sage-200 rounded-full focus:outline-none focus:ring-2 focus:ring-sage-400 transition-all duration-300">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <!-- 2. Filter Kategori -->
        <div class="relative">
            <select name="category" class="w-full md:w-auto appearance-none bg-white border-2 border-sage-200 hover:border-sage-400 rounded-full py-3 pl-4 pr-10 text-sage-800 focus:outline-none focus:ring-4 focus:ring-sage-100 focus:border-sage-400 transition-all duration-300 cursor-pointer font-medium">
                <option value="">Semua Kategori</option>
                <option value="lantai">Keramik Lantai</option>
                <option value="tangga">Step Nosing Tangga</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-sage-600">
                <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
            </div>
        </div>
    </div>
</form>

        <!-- Grid Produk -->
        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 sm:gap-12"> --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4 sm:gap-12 px-16">

            @foreach($products as $index => $product)
            <a href="{{ route('products.show', $product['id']) }}"
               class="group block animate-fade-in-up"
               style="animation-delay: {{ $index * 80 }}ms;">

                {{-- <div class="relative bg-[#e8f0e8] rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3"> --}}
                <div class="relative bg-[#e8f0e8] rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 max-w-sm mx-auto">

                    <!-- Image Container -->
                    {{-- <div class="relative overflow-hidden aspect-square bg-cream-50"> --}}
                    <div class="relative overflow-hidden h-56 bg-cream-50">

                        <img src="{{ $product['image'] }}"
                             alt="{{ $product['name'] }}"
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-sage-900/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Badge -->
                        <div class="absolute top-4 left-4 bg-sage-600 text-white px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide transform -translate-y-12 group-hover:translate-y-0 transition-transform duration-300">
                            Baru
                        </div>

                        <!-- Quick Actions -->
                        <div class="absolute bottom-4 right-4 flex gap-2 transform translate-y-12 group-hover:translate-y-0 transition-transform duration-300">
                            <button class="bg-white/90 backdrop-blur-sm hover:bg-sage-600 text-sage-800 hover:text-white p-2.5 rounded-full transition-all duration-300 shadow-lg hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                            <button class="bg-white/90 backdrop-blur-sm hover:bg-sage-600 text-sage-800 hover:text-white p-2.5 rounded-full transition-all duration-300 shadow-lg hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-sage-900 group-hover:text-sage-600 transition-colors duration-300 mb-2 line-clamp-2 min-h-[3.5rem]">
                            {{ $product['name'] }}
                        </h3>

                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-2xl font-bold text-sage-700">
                                    {{ $product['price'] }}
                                </p>
                                <div class="flex items-center gap-1 mt-1">
                                    <div class="flex text-amber-400">
                                        @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-sage-600 ml-1">(4.8)</span>
                                </div>
                            </div>

                            <button class="w-12 h-12 rounded-full bg-sage-600 hover:bg-sage-700 flex items-center justify-center text-white transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
