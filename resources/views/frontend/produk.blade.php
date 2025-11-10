@extends('frontend.layouts.app')

@section('content')
<div class="bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-0 sm:py-12">
        <div class="text-center mb-12 animate-fade-in-down">
            <h1 class="text-4xl sm:text-5xl font-bold text-sage-900">Koleksi Produk Kami</h1>
            <p class="mt-4 text-lg text-sage-600 max-w-2xl mx-auto">Temukan keramik berkualitas tinggi dengan berbagai motif dan ukuran untuk setiap kebutuhan ruangan Anda.</p>
        </div>

        <form action="{{ route('produk') }}" method="GET" class="animate-fade-in mt-4 mb-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">

                <div class="relative w-full md:w-2/5 ml-14">
                    {{-- ... (Search bar tidak berubah) ... --}}
                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        value="{{ request('search') }}"
                        placeholder="Cari produk yang anda inginkan..."
                        class="w-full pl-5 pr-24 py-3 border-2 border-sage-200 rounded-full focus:outline-none focus:ring-2 focus:ring-sage-400 transition-all duration-300 shadow-lg bg-white"
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2">

                        <button
                            type="button"
                            id="resetButton"
                            onclick="document.getElementById('searchInput').value = ''; this.form.submit();"
                            class="p-2 text-gray-500 hover:text-gray-800 hover:bg-gray-200 rounded-full transition-colors duration-300"
                            style="display: none;"
                            title="Hapus pencarian">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>

                        <button type="submit" class="p-2 ml-1 bg-sage-600 text-white hover:bg-sage-700 rounded-full transition-colors duration-300" title="Cari">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>

                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto mr-14">

                    {{-- POIN 4: Filter Kategori dibuat dinamis & fungsional --}}
                    <div class="relative group">
                        <select name="category" onchange="this.form.submit()" class="w-full sm:w-48 appearance-none bg-white border-2 border-sage-200 hover:border-sage-400 rounded-xl py-3 pl-4 pr-10 text-sage-800 focus:outline-none focus:ring-4 focus:ring-sage-100 transition-all duration-300 cursor-pointer font-medium">
                            {{-- <option value="">Semua Kategori</option>
                            {{-- Ini hanya contoh statis, di halaman produk.blade.php akan dinamis --}}
                            {{-- Anda bisa ganti value="1" dst. sesuai ID kategori di DB Anda --}
                            <option value="1">Keramik</option>
                            <option value="2">Step Nosing Tangga</option>
                            <option value="3">Pintu Kamar Mandi</option>
                            <option value="4">Wastafel</option>
                            <option value="5">Shower</option>
                            <option value="6">Kloset</option> --}}
                            <option value="">Semua Kategori</option>
                            {{-- Loop dari controller (pastikan controller sudah mengirim $categories) --}}
                            @isset($categories)
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-sage-600">
                            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </div>
                    </div>

                    {{-- POIN 4: Filter Urutkan diberi value & fungsional --}}
                    <div class="relative group">
                        <select name="sort" onchange="this.form.submit()" class="w-full sm:w-48 appearance-none bg-white border-2 border-sage-200 hover:border-sage-400 rounded-xl py-3 pl-4 pr-10 text-sage-800 focus:outline-none focus:ring-4 focus:ring-sage-100 transition-all duration-300 cursor-pointer font-medium">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                            <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Harga: Terendah</option>
                            <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Harga: Tertinggi</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-sage-600">
                            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                        </div>
                    </div>
                </div>

            </div>
        </form>

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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-10 px-16">
            @forelse($products as $index => $product) {{-- Ganti ke @forelse --}}

            {{-- POIN 1: Wrapper diubah dari <a> menjadi <div> --}}
            <div class="group block animate-fade-in-up"
                style="animation-delay: {{ $index * 80 }}ms;">

                <div class="relative bg-[#e8f0e8] border border-sage-300 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-400 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden h-48 bg-cream-50">
                        <img src="{{ $product->gambar_produk ? asset('storage/' . $product->gambar_produk) : asset('storage/products/default.png') }}"
                                alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">

                        <div class="absolute inset-0 bg-gradient-to-t from-sage-900/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <div class="absolute top-4 left-4 bg-sage-600 text-white px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide transform -translate-y-12 group-hover:translate-y-0 transition-transform duration-300">
                            Baru
                        </div>

                        <div class="absolute bottom-4 right-4 flex gap-2 transform translate-y-12 group-hover:translate-y-0 transition-transform duration-300">
                            {{-- <button class="bg-white/90 backdrop-blur-sm hover:bg-sage-600 text-sage-800 hover:text-white p-2.5 rounded-full transition-all duration-300 shadow-lg hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button> --}}

                            {{-- POIN 1: Link hanya ada di ikon mata --}}
                            <a href="{{ route('products.show', $product->id) }}" class="bg-white/90 backdrop-blur-sm hover:bg-sage-600 text-sage-800 hover:text-white p-2.5 rounded-full transition-all duration-300 shadow-lg hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                        </div>
                    </div>


                    <div class="p-5">
                        <p class="text-xs font-semibold text-sage-600 uppercase tracking-wider mb-2">
                             {{-- Controller sudah 'with('category')' --}}
                            {{ $product->category->name ?? 'Tidak Berkategori' }}
                        </p>

                        <h3 class="text-lg font-bold text-sage-900 group-hover:text-sage-600 transition-colors duration-300 mb-1 h-14 overflow-hidden">
                            {{ $product->nama_produk }}
                        </h3>

                        {{-- <p class="text-xs text-gray-500 opacity-70 mt-1 mb-3 line-clamp-2 h-8">
                            {{ $product->deskripsi }}
                        </p> --}}

                        <div class="flex items-center justify-between mt-4"> {{-- Tambah mt-4 --}}
                            <div>
                                <p class="text-xl font-bold text-sage-800">
                                    {{ 'Rp ' . number_format($product->harga_jual, 0, ',', '.') }}
                                </p>
                                <div class="mt-1">
                                    <p class="text-xs font-semibold text-sage-600 uppercase tracking-wider">
                                        {{ $product->merek }}
                                    </p>
                                </div>
                            </div>

                            {{-- POIN 3: Tombol Add to Cart dengan logika login --}}
                            @if (Auth::guard('customer')->check())
                                {{-- Jika login, arahkan ke form pemesanan --}}
                                <a href="{{ route('customer.formPemesanan', ['id' => $product->id]) }}"
                                    class="w-12 h-12 rounded-full bg-sage-600 hover:bg-sage-700 flex items-center justify-center text-white transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </a>
                            @else
                                {{-- Jika guest, buka modal login --}}
                                <button type="button" onclick="openModal('loginModal')"
                                    class="w-12 h-12 rounded-full bg-sage-600 hover:bg-sage-700 flex items-center justify-center text-white transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div> {{-- POIN 1: Penutup </div> --}}

            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 text-center py-12">
                    <p class="text-lg text-sage-600">Produk tidak ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $products->links() }}
        </div>

    </div>
</div>
@endsection
