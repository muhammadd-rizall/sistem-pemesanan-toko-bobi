@extends('frontend.layouts.app')

@section('content')
<div class="bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-0 sm:py-12">
        <!-- Header Halaman -->
        <div class="text-center mb-12 animate-fade-in-down">
            <h1 class="text-4xl sm:text-5xl font-bold text-sage-900">Koleksi Produk Kami</h1>
            <p class="mt-4 text-lg text-sage-600 max-w-2xl mx-auto">Temukan keramik berkualitas tinggi dengan berbagai motif dan ukuran untuk setiap kebutuhan ruangan Anda.</p>
        </div>

        <!-- Filter dan Search -->
        <form action="{{ route('produk') }}" method="GET" class="animate-fade-in mt-4 mb-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">

                <!-- 1. Input Search dengan Tombol Reset & Submit -->
                <div class="relative w-full md:w-2/5">
                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        value="{{ request('search') }}"
                        placeholder="Cari produk yang anda inginkan..."
                        class="w-full pl-5 pr-24 py-3 border-2 border-sage-200 rounded-full focus:outline-none focus:ring-2 focus:ring-sage-400 transition-all duration-300 shadow-lg bg-white"
                    >
                    <!-- Grup Tombol di Dalam Input -->
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2">

                        <!-- Tombol Reset (X) -->
                        <button
                            type="button"
                            id="resetButton"
                            onclick="document.getElementById('searchInput').value = ''; this.form.submit();"
                            class="p-2 text-gray-500 hover:text-gray-800 hover:bg-gray-200 rounded-full transition-colors duration-300"
                            style="display: none;"
                            title="Hapus pencarian">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>

                        <!-- Tombol Submit Pencarian -->
                        <button type="submit" class="p-2 ml-1 bg-sage-600 text-white hover:bg-sage-700 rounded-full transition-colors duration-300" title="Cari">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>

                    </div>
                </div>

                <!-- 2. Filter Kategori & Urutkan -->
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <!-- ... (kode select kategori dan urutkan Anda tetap sama) ... -->
                    <div class="relative group">
                        <select name="category" class="w-full sm:w-48 appearance-none bg-white border-2 border-sage-200 hover:border-sage-400 rounded-xl py-3 pl-4 pr-10 text-sage-800 focus:outline-none focus:ring-4 focus:ring-sage-100 transition-all duration-300 cursor-pointer font-medium">
                            <option value="">Semua Kategori</option>
                            <option value="lantai">Keramik Lantai</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-sage-600">
                            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </div>
                    </div>
                    <div class="relative group">
                        <select name="sort" class="w-full sm:w-48 appearance-none bg-white border-2 border-sage-200 hover:border-sage-400 rounded-xl py-3 pl-4 pr-10 text-sage-800 focus:outline-none focus:ring-4 focus:ring-sage-100 transition-all duration-300 cursor-pointer font-medium">
                            <option value="terbaru">Urutkan: Terbaru</option>
                            <option value="harga_asc">Harga: Terendah</option>
                            <option value="harga_desc">Harga: Tertinggi</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-sage-600">
                            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                        </div>
                    </div>
                </div>

            </div>
        </form>

<!-- Script untuk Tombol Reset -->
<script>
    const searchInput = document.getElementById('searchInput');
    const resetButton = document.getElementById('resetButton');

    function toggleResetButtonVisibility() {
        if (searchInput.value) {
            resetButton.style.display = 'block';
        } else {
            resetButton.style.display = 'none';
        }
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', toggleResetButtonVisibility);

    // Jalankan setiap kali ada ketikan di input
    searchInput.addEventListener('input', toggleResetButtonVisibility);
</script>

        <!-- Grid Produk -->
        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 sm:gap-12"> --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-10 px-16">
            @foreach($products as $index => $product)
            <a href="{{ route('products.show', $product['id']) }}"
               class="group block animate-fade-in-up"
               style="animation-delay: {{ $index * 80 }}ms;">

                {{-- <div class="relative bg-[#e8f0e8] rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3"> --}}
                <div class="relative bg-[#e8f0e8] border border-sage-300 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-400 transform hover:-translate-y-2">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden h-48 bg-cream-50">
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
                            <!-- Merek -->
                            {{-- <p class="text-xs font-semibold text-sage-600 uppercase tracking-wider mb-2">
                                {{ $product['merek'] }}
                            </p> --}}

                            <!-- Nama Produk -->
                            <h3 class="text-lg font-bold text-sage-900 group-hover:text-sage-600 transition-colors duration-300 mb-1 h-14 overflow-hidden">
                                {{ $product['name'] }}
                            </h3>

                            <!-- Deskripsi Singkat -->
                            <p class="text-xs text-gray-500 opacity-70 mt-1 mb-3 line-clamp-2 h-8">
                                {{ $product['deskripsi'] }}
                            </p>

                            <!-- Info Harga & Stok -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <!-- Harga -->
                                    <p class="text-xl font-bold text-sage-800">
                                        {{ $product['price'] }}
                                    </p>
                                    <!-- Status Stok (Contoh Statis) -->
                                    <div class="mt-1">
                                        <p class="text-xs font-semibold text-sage-600 uppercase tracking-wider mb-2">
                                            {{ $product['merek'] }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Tombol Add to Cart -->
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
