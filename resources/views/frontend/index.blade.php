@extends('frontend.layouts.app')

@section('content')
<!-- Hero Section with Stunning Design -->
<section class="relative w-full h-screen flex items-center justify-center text-center text-white overflow-hidden">
    <img src="{{ asset('storage/images/background-hero.jpg') }}"
         alt="Background Keramik"
         class="absolute inset-0 w-full h-full object-cover object-center">

    <div class="absolute inset-0 bg-black opacity-50"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-2">
        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold text-white mb-6 animate-fade-in-down leading-tight drop-shadow-md">
            <span class="text-sage-300">Percantik</span> Ruangan dengan Keramik <span class="text-sage-300">Terbaik</span>
        </h1>
        <p class="text-lg sm:text-xl text-gray-200 max-w-2xl mx-auto leading-relaxed animate-fade-in-up mb-16 drop-shadow-sm">
            Jelajahi koleksi keramik terbaik kami, dirancang untuk memperindah ruangan dengan keindahan dan kualitas yang tahan lama.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="/product/1" class="bg-sage-600 hover:bg-sage-700 border border-white/30 hover:bg-white/30 text-white font-bold px-8 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">Lihat Produk</a>
            {{-- <a href="#contact" class="bg-white/20 backdrop-blur-sm border border-sage/700 hover:bg-white/30 text-white font-bold px-8 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">Konsultasi Gratis</a> --}}
        </div>
    </div>
</section>

<div class="relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-gradient-to-br from-sage-50 via-white to-cream-50"></div>

    <div class="container relative mx-auto px-4 sm:px-6 lg:px-12 py-12 sm:py-16 lg:py-20">


        <!-- Search Bar -->
        <div class="max-w-4xl mx-auto text-center mb-16 sm:mb-12">
            <div class="max-w-2xl mx-auto animate-fade-in-up animation-delay-200">
                <div class="relative">
                    <input type="text"
                           placeholder="Cari produk anda..."
                           class="w-full px-6 py-4 pr-14 rounded-full border-2 border-sage-200 focus:border-sage-400 focus:outline-none focus:ring-4 focus:ring-sage-100 transition-all duration-300 text-sage-800 placeholder-sage-400">
                    <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-sage-600 hover:bg-sage-700 text-white p-3 rounded-full transition-all duration-300 hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-12 animate-fade-in">
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-sage-900 mb-2">Koleksi Kami</h2>
                <p class="text-sage-600">Produk pilihan khusus untuk Anda</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                <!-- Category Filter -->
                <div class="relative group">
                    <select class="w-full sm:w-48 appearance-none bg-white border-2 border-sage-200 hover:border-sage-400 rounded-xl py-3 pl-4 pr-10 text-sage-800 focus:outline-none focus:ring-4 focus:ring-sage-100 focus:border-sage-400 transition-all duration-300 cursor-pointer font-medium">
                        <option>Semua Kategori</option>
                        <option>Keramik Lantai</option>
                        <option>Step Nosing Tangga</option>
                        <option>Pintu Kamar Mandi</option>
                        <option>Wastafel</option>
                        <option>Shower</option>
                        <option>Kloset</option>

                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-sage-600">
                        <svg class="fill-current h-5 w-5 transform group-hover:scale-110 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                        </svg>
                    </div>
                </div>

                <!-- Sort Filter -->
                <div class="relative group">
                    <select class="w-full sm:w-48 appearance-none bg-white border-2 border-sage-200 hover:border-sage-400 rounded-xl py-3 pl-4 pr-10 text-sage-800 focus:outline-none focus:ring-4 focus:ring-sage-100 focus:border-sage-400 transition-all duration-300 cursor-pointer font-medium">
                        {{-- <option>Urutkan berdasarkan Populer</option> --}}
                        <option>Harga: Terendah ke Tertinggi</option>
                        <option>Harga: Tertinggi ke Terendah</option>
                        {{-- <option>Terbaru Pertama</option>
                        <option>Rating Terbaik</option> --}}
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-sage-600">
                        <svg class="fill-current h-5 w-5 transform group-hover:scale-110 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-12">
            @foreach($products as $index => $product)
            <a href="{{ route('products.show', $product['id']) }}"
               class="group block animate-fade-in-up"
               style="animation-delay: {{ $index * 80 }}ms;">

                <div class="relative bg-[#e8f0e8] rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden aspect-square bg-cream-50">
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

        <!-- Load More Button -->
        <div class="mt-16 text-center animate-fade-in mb-32">
            <button class="group inline-flex items-center gap-2 px-8 py-4 bg-sage-600 hover:bg-sage-700 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                Muat Lebih Banyak Produk
                <svg class="w-5 h-5 transform group-hover:translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>


        <!-- Keunggulan Section -->
        <section id="keunggulan" class="py-16 sm:py-4">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center mb-16 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-sage-900 mb-3">
                Mengapa Bobi Ceramic's?
            </h2>
            <p class="text-lg text-sage-600">
                Keunggulan yang kami tawarkan untuk Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="mx-auto w-20 h-20 mb-6 flex items-center justify-center bg-gradient-to-br from-sage-100 to-sage-200 rounded-full text-sage-600 shadow-sm">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-sage-900 mb-2">Tersedia Berbagai Motif</h3>
                <p class="text-sage-700 leading-relaxed text-balance">Dari modern minimalis hingga klasik, temukan motif yang sempurna untuk ruangan Anda.</p>
            </div>

            <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="mx-auto w-20 h-20 mb-6 flex items-center justify-center bg-gradient-to-br from-sage-100 to-sage-200 rounded-full text-sage-600 shadow-sm">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-sage-900 mb-2">Harga yang Terjangkau</h3>
                <p class="text-sage-700 leading-relaxed text-balance">Dapatkan produk berkualitas dengan harga yang sesuai untuk kebutuhan Anda.</p>
            </div>

            <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="mx-auto w-20 h-20 mb-6 flex items-center justify-center bg-gradient-to-br from-sage-100 to-sage-200 rounded-full text-sage-600 shadow-sm">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V7a2 2 0 012-2h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H17z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-sage-900 mb-2">Gratis Konsultasi Desain</h3>
                <p class="text-sage-700 leading-relaxed text-balance">Bingung memilih? Tim ahli kami siap memberikan rekomendasi terbaik untuk Anda.</p>
            </div>

        </div>
    </div>
</section>

    </div>
</div>







<!-- Custom Animations & Styles -->
<style>
    @keyframes fade-in-down {
        0% {
            opacity: 0;
            transform: translateY(-30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in-up {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    .animate-fade-in-down {
        animation: fade-in-down 0.8s ease-out;
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out;
        animation-fill-mode: both;
    }

    .animate-fade-in {
        animation: fade-in 0.6s ease-out;
    }

    .animation-delay-200 {
        animation-delay: 0.2s;
    }
</style>
@endsection
