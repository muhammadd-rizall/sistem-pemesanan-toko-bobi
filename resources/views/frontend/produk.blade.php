@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-0 sm:py-12">

            {{-- ============================================ --}}
            {{-- PAGE HEADER (RATA TENGAH) --}}
            {{-- ============================================ --}}
            <div class="text-center mb-12 animate-fade-in-down mt-6">
                <h1 class="text-4xl sm:text-5xl font-bold text-sage-900">
                    Koleksi Produk Kami
                </h1>
                <p class="mt-3 text-lg text-sage-600 max-w-2xl mx-auto mb-16">
                    Temukan keramik berkualitas tinggi dengan berbagai motif dan ukuran untuk setiap kebutuhan ruangan Anda.
                </p>
            </div>

            {{-- ============================================ --}}
            {{-- SEARCH & FILTER FORM (RATA KIRI) --}}
            {{-- ============================================ --}}
            <form action="{{ route('produk') }}" method="GET" class="animate-fade-in mt-4 mb-10">
                <div class="flex flex-col md:flex-row md:justify-center items-end gap-4 flex-wrap">

                    {{-- Search Bar --}}
                    <div class="relative w-full md:w-1/3">
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            placeholder="Cari produk yang anda inginkan..."
                            class="w-full pl-5 pr-24 py-3 border-2 border-sage-300 rounded-full focus:outline-none focus:ring-2 focus:ring-sage-500 transition-all duration-300 shadow-sm bg-white text-sage-700">

                        <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                            {{-- Reset Button --}}
                            <button type="button" id="resetButton"
                                onclick="document.getElementById('searchInput').value = ''; this.form.submit();"
                                title="Hapus pencarian" style="display: none;"
                                class="p-2 text-sage-500 hover:text-sage-800 hover:bg-sage-100 rounded-full transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            {{-- Search Button --}}
                            <button type="submit" title="Cari"
                                class="p-2 ml-1 bg-sage-600 text-white hover:bg-sage-700 rounded-full transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Filter Kategori --}}
                    <select name="category" onchange="this.form.submit()"
                        class="w-full md:w-48 h-12 border-2 border-sage-300 focus:outline-none focus:ring-2 focus:ring-sage-500 text-sage-700 rounded-lg px-3 bg-white transition-all duration-200">
                        <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Sortir --}}
                    <select name="sort" onchange="this.form.submit()"
                        class="w-full md:w-48 h-12 border-2 border-sage-300 focus:outline-none focus:ring-2 focus:ring-sage-500 text-sage-700 rounded-lg px-3 bg-white transition-all duration-200">
                        <option value="">Urutkan</option>
                        <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Harga Terendah
                        </option>
                        <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Harga Tertinggi
                        </option>
                    </select>

                </div>
            </form>

            {{-- ============================================ --}}
            {{-- PRODUCTS GRID --}}
            {{-- ============================================ --}}
            @if ($products->isEmpty())
                <div class="max-w-4xl mx-auto px-4 text-center py-12">
                    <p class="text-gray-500 text-lg">
                        😔 Maaf, tidak ada barang ditemukan sesuai pencarian atau filter yang kamu pilih.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-10 px-2 sm:px-8">
                    @foreach ($products as $index => $product)
                        <div class="group block animate-fade-in-up" style="animation-delay: {{ $index * 80 }}ms;">
                            <div
                                class="relative bg-[#f5f8f5] border border-sage-300 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-400 transform hover:-translate-y-2">

                                {{-- Product Image --}}
                                <div class="relative overflow-hidden h-48 bg-cream-50">
                                    <img src="{{ $product->gambar_produk ? asset('storage/' . $product->gambar_produk) : asset('storage/products/default.png') }}"
                                        alt="{{ $product->nama_produk }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">

                                    {{-- Overlay --}}
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-sage-900/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    </div>

                                    {{-- Badge Baru --}}
                                    <div
                                        class="absolute top-4 left-4 bg-sage-600 text-white px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide transform -translate-y-12 group-hover:translate-y-0 transition-transform duration-300">
                                        Baru
                                    </div>

                                    {{-- Tombol Detail --}}
                                    <div
                                        class="absolute bottom-4 right-4 transform translate-y-12 group-hover:translate-y-0 transition-transform duration-300 ease-out">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="bg-white/90 backdrop-blur-sm hover:bg-sage-300 text-sage-700 hover:text-white p-2.5 rounded-full transition-all duration-300 shadow-lg hover:scale-110 flex items-center justify-center">
                                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110"
                                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5
                           c4.478 0 8.268 2.943 9.542 7
                           -1.274 4.057-5.064 7-9.542 7
                           -4.477 0-8.268-2.943-9.542-7z" />
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
                                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                            </p>
                                            <p class="text-xs font-semibold text-sage-600 uppercase tracking-wider mt-1">
                                                {{ $product->merek }}
                                            </p>
                                        </div>
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

                {{-- PAGINATION --}}
                <div class="mt-16">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- JAVASCRIPT --}}
    {{-- ============================================ --}}
    <script>
        const searchInput = document.getElementById('searchInput');
        const resetButton = document.getElementById('resetButton');

        function toggleResetButtonVisibility() {
            resetButton.style.display = searchInput.value ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', toggleResetButtonVisibility);
        searchInput.addEventListener('input', toggleResetButtonVisibility);
    </script>
@endsection
