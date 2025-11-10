@extends('frontend.layouts.app')

@section('content')
    {{-- ============================================ --}}
    {{-- HERO SECTION --}}
    {{-- ============================================ --}}
    <section class="relative w-full h-screen flex items-center justify-center text-center text-white overflow-hidden">
        <img src="{{ asset('storage/images/background-hero.jpg') }}" alt="Background Keramik"
            class="absolute inset-0 w-full h-full object-cover object-center">

        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-2">
            <h1
                class="text-4xl sm:text-5xl lg:text-7xl font-bold text-white mb-6 animate-fade-in-down leading-tight drop-shadow-md">
                <span class="text-sage-300">Percantik</span> Ruangan dengan Keramik <span class="text-sage-300">Terbaik</span>
            </h1>

            <p
                class="text-lg sm:text-xl text-gray-200 max-w-2xl mx-auto leading-relaxed animate-fade-in-up mb-16 drop-shadow-sm">
                Jelajahi koleksi keramik terbaik kami, dirancang untuk memperindah ruangan dengan keindahan dan kualitas
                yang tahan lama.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('produk') }}"
                    class="bg-sage-600 hover:bg-sage-700 border border-white/30 text-white font-bold px-8 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
                    Beli Sekarang →
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- PRODUCTS SECTION --}}
    {{-- ============================================ --}}
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-sage-50 via-white to-cream-50"></div>

        <div class="container relative mx-auto px-4 sm:px-6 lg:px-12 py-12 sm:py-16 lg:py-20">

            {{-- Search Bar --}}
            {{-- <form action="{{ route('produk') }}" method="GET" class="max-w-4xl mx-auto mb-12">
                <div class="max-w-2xl mx-auto animate-fade-in-up animation-delay-200">
                    <div class="relative flex items-center">
                        <input type="text" name="search" id="searchInput"
                            placeholder="Cari produk yang anda inginkan..." value="{{ request('search') }}"
                            class="w-full px-6 py-4 pr-28 rounded-full border border-sage-300 focus:border-sage-500 focus:outline-none focus:ring-2 focus:ring-sage-100 transition-all duration-300 text-sage-800 bg-white shadow-lg">

                        {{-- Reset Button --}
                        <button type="button" id="resetButton"
                            onclick="document.getElementById('searchInput').value=''; this.form.submit();"
                            title="Reset pencarian"
                            class="absolute right-12 top-1/2 -translate-y-1/2 bg-gray-200 hover:bg-gray-300 text-gray-700 mr-2 p-3 rounded-full transition-all duration-300 hover:scale-110">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        {{-- Search Button --}
                        <button type="submit" title="Cari"
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-sage-600 hover:bg-sage-700 text-white p-3 rounded-full transition-all duration-300 hover:scale-110">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form> --}}

            {{-- Filter Section --}}
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-12 animate-fade-in mt-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-sage-900 mb-2 pl-4 ml-4">Koleksi Kami</h2>
                    <p class="text-sage-600 pl-8">Produk pilihan khusus untuk Anda</p>
                </div>

                {{-- <form action="{{ route('produk') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    {{-- Category Filter --
                    <div class="relative group">
                        <select name="category" onchange="this.form.submit()"
                            class="w-full sm:w-48 appearance-none bg-white border-2 border-sage-200 hover:border-sage-400 rounded-xl py-3 pl-4 pr-10 text-sage-800 focus:outline-none focus:ring-4 focus:ring-sage-100 focus:border-sage-400 transition-all duration-300 cursor-pointer font-medium">
                            <option value="">Semua Kategori</option>
                            <option value="1">Keramik</option>
                            <option value="2">Step Nosing Tangga</option>
                            <option value="3">Pintu Kamar Mandi</option>
                            <option value="4">Wastafel</option>
                            <option value="5">Shower</option>
                            <option value="6">Kloset</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-sage-600">
                            <svg class="fill-current h-5 w-5 transform group-hover:scale-110 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Sort Filter --
                    <div class="relative group">
                        <select name="sort" onchange="this.form.submit()"
                            class="w-full sm:w-48 appearance-none bg-white border-2 border-sage-200 hover:border-sage-400 rounded-xl py-3 pl-4 pr-10 text-sage-800 focus:outline-none focus:ring-4 focus:ring-sage-100 focus:border-sage-400 transition-all duration-300 cursor-pointer font-medium">
                            <option value="terbaru">Urutkan: Terbaru</option>
                            <option value="harga_asc">Harga: Terendah</option>
                            <option value="harga_desc">Harga: Tertinggi</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-sage-600">
                            <svg class="fill-current h-5 w-5 transform group-hover:scale-110 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z" />
                            </svg>
                        </div>
                    </div>
                </form> --}}
            </div>

            {{-- Products Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-10 px-10">
                @foreach ($products as $index => $product)
                    <div class="group block animate-fade-in-up" style="animation-delay: {{ $index * 80 }}ms;">
                        <div
                            class="relative bg-[#e8f0e8] border border-sage-300 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-400 transform hover:-translate-y-2">

                            {{-- Image Container --}}
                            <div class="relative overflow-hidden h-48 bg-cream-50">
                                <img src="{{ $product->gambar_produk ? asset('storage/' . $product->gambar_produk) : asset('images/no-image.jpg') }}"
                                    alt="{{ $product->nama_produk }}"
                                    onerror="this.src='{{ asset('images/no-image.jpg') }}'"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-sage-900/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                </div>

                                {{-- Badge --}}
                                <div
                                    class="absolute top-4 left-4 bg-sage-600 text-white px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide transform -translate-y-12 group-hover:translate-y-0 transition-transform duration-300">
                                    Baru
                                </div>

                                {{-- Quick Actions --}}
                                <div
                                    class="absolute bottom-4 right-4 flex gap-2 transform translate-y-12 group-hover:translate-y-0 transition-transform duration-300">
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="bg-white/90 backdrop-blur-sm hover:bg-sage-600 text-sage-800 hover:text-white p-2.5 rounded-full transition-all duration-300 shadow-lg hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            {{-- Product Info --}}
                            <div class="p-5">
                                <p class="text-xs font-semibold text-sage-600 uppercase tracking-wider mb-2">
                                    {{ $product->category->name ?? 'Tidak Berkategori' }}
                                </p>

                                <h3
                                    class="text-lg font-bold text-sage-900 group-hover:text-sage-600 transition-colors duration-300 mb-3 line-clamp-2">
                                    {{ $product->nama_produk }}
                                </h3>

                                <div class="flex items-center justify-between mt-4">
                                    <div>
                                        <p class="text-xl font-bold text-sage-800">
                                            Rp {{ number_format((float) $product->harga_jual, 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs font-semibold text-sage-600 uppercase tracking-wider mt-1">
                                            {{ $product->merek }}
                                        </p>
                                    </div>

                                    {{-- Add to Cart Button --}}
                                    @if (Auth::guard('customer')->check())
                                        <a href="{{ route('customer.formPemesanan', ['id' => $product->id]) }}"
                                            class="w-12 h-12 rounded-full bg-sage-600 hover:bg-sage-700 flex items-center justify-center text-white transform group-hover:scale-110 transition-all duration-300 shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </a>
                                    @else
                                        <button type="button" onclick="openModal('loginModal')"
                                            class="w-12 h-12 rounded-full bg-sage-600 hover:bg-sage-700 flex items-center justify-center text-white transform group-hover:scale-110 transition-all duration-300 shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- View All Products Button --}}
            <div class="mt-12 mb-4 text-center">
                <a href="{{ route('produk') }}"
                    class="group inline-flex items-center gap-2 px-8 py-4 bg-sage-600 hover:bg-sage-700 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    Lihat Semua Produk
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- KEUNGGULAN SECTION --}}
    {{-- ============================================ --}}
    <section id="keunggulan" class="py-16 sm:py-4">
        <div class="container mx-auto px-0 sm:px-0 lg:px-0">
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-sage-900 mb-3">
                    Mengapa Bobi Ceramic's?
                </h2>
                <p class="text-lg text-sage-600">
                    Keunggulan yang kami tawarkan untuk Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 sm:gap-10 px-16">
                {{-- Card 1: Berbagai Motif --}}
                <div class="bg-white p-8 rounded-2xl border border-sage-200 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 animate-fade-in-up"
                    style="animation-delay: 0.1s;">
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="mx-auto w-20 h-20 mb-6 flex items-center justify-center bg-gradient-to-br from-sage-100 to-sage-200 rounded-full text-sage-600">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-sage-900 mb-2">Tersedia Berbagai Motif</h3>
                        <p class="text-sage-700 leading-relaxed text-balance">
                            Dari modern minimalis hingga klasik, temukan motif yang sempurna untuk ruangan Anda.
                        </p>
                    </div>
                </div>

                {{-- Card 2: Harga Terjangkau --}}
                <div class="bg-white p-8 rounded-2xl border border-sage-200 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 animate-fade-in-up"
                    style="animation-delay: 0.2s;">
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="mx-auto w-20 h-20 mb-6 flex items-center justify-center bg-gradient-to-br from-sage-100 to-sage-200 rounded-full text-sage-600">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-sage-900 mb-2">Harga yang Terjangkau</h3>
                        <p class="text-sage-700 leading-relaxed text-balance">
                            Dapatkan produk berkualitas dengan harga yang sesuai untuk kebutuhan Anda.
                        </p>
                    </div>
                </div>

                {{-- Card 3: Konsultasi Desain --}}
                <div class="bg-white p-8 rounded-2xl border border-sage-200 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 animate-fade-in-up"
                    style="animation-delay: 0.3s;">
                    <div class="flex flex-col items-center text-center">
                        <div
                            class="mx-auto w-20 h-20 mb-6 flex items-center justify-center bg-gradient-to-br from-sage-100 to-sage-200 rounded-full text-sage-600">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V7a2 2 0 012-2h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H17z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-sage-900 mb-2">Gratis Konsultasi Desain</h3>
                        <p class="text-sage-700 leading-relaxed text-balance">
                            Bingung memilih? Tim ahli kami siap memberikan rekomendasi terbaik untuk Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- LOKASI TOKO SECTION --}}
    {{-- ============================================ --}}
    <section id="lokasi" class="bg-white mb-8 sm:mb-4 p-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center mb-10 mt-20">
                <h2 class="text-3xl sm:text-4xl font-bold text-sage-900 mb-3">
                    Kunjungi Toko Kami
                </h2>
                <p class="text-lg text-sage-600">
                    Kami siap menyambut Anda dan membantu menemukan produk yang tepat.
                </p>
            </div>

            <div class="bg-white rounded-2xl border-2 border-sage-200 shadow-xl overflow-hidden animate-fade-in-up">
                <div class="grid grid-cols-1 lg:grid-cols-3">
                    {{-- Store Info --}}
                    <div class="lg:col-span-1 p-8 bg-sage-50 flex flex-col justify-center">
                        <h3 class="text-2xl font-bold text-sage-900 mb-6">Bobi Ceramic's Padang</h3>

                        <div class="space-y-5">
                            {{-- Address --}}
                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 text-sage-600 mt-1 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-sage-800">Alamat</h4>
                                    <p class="text-sage-700">
                                        Jl. Kp. Kalawi Jl. Kp. Lalang No.11, Lubuk Lintah, Kec. Kuranji, Kota Padang,
                                        Sumatera Barat 25175
                                    </p>
                                </div>
                            </div>

                            {{-- Operating Hours --}}
                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 text-sage-600 mt-1 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-sage-800">Jam Operasional</h4>
                                    <p class="text-sage-700">Senin - Sabtu: 08:00 - 16:00 WIB</p>
                                    <p class="text-sage-700">Minggu: Tutup</p>
                                </div>
                            </div>
                        </div>

                        {{-- Direction Button --}}
                        <div class="mt-8">
                            <a href="https://maps.app.goo.gl/CGU4ChUTUydwiTYb6" target="_blank"
                                class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 bg-sage-600 text-white font-bold rounded-lg hover:bg-sage-700 transition-all duration-300 shadow-md transform hover:scale-105">
                                Dapatkan Arah
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Map --}}
                    <div class="lg:col-span-2 h-80 lg:h-full">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2998797168048!2d100.39208897411788!3d-0.9236666990674066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8ff554d4235%3A0xf6a316c972be521b!2sToko%20Keramik%20Bobi!5e0!3m2!1sid!2sid!4v1760443143438!5m2!1sid!2sid"
                            class="w-full h-full border-0" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================ --}}
    {{-- JAVASCRIPT --}}
    {{-- ============================================ --}}
    <script>
        // Toggle Reset Button Visibility
        const searchInput = document.getElementById('searchInput');
        const resetButton = document.getElementById('resetButton');

        function toggleReset() {
            resetButton.style.display = searchInput.value ? 'block' : 'none';
        }

        searchInput.addEventListener('input', toggleReset);
        document.addEventListener('DOMContentLoaded', toggleReset);
    </script>

    {{-- ============================================ --}}
    {{-- CUSTOM ANIMATIONS --}}
    {{-- ============================================ --}}
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
