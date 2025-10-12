@extends('admin.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Alert Sukses -->
        @if (session('success'))
            <div id="success-alert"
                class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-md flex items-center justify-between"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm">{{ session('success') }}</span>
                </div>
                <button type="button" class="text-green-700 hover:text-green-900"
                    onclick="document.getElementById('success-alert').remove();">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="animate-fade-in">

            <!-- Header Halaman -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-sage-800">Manajemen Produk</h1>
                    <p class="text-sage-600 mt-1">Kelola semua item produk di toko Anda.</p>
                </div>
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <!-- Search Bar -->
                    <form action="{{ route('produk_view') }}" method="GET" class="w-full sm:w-auto">
                        <div class="relative w-full sm:w-64">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari produk..."
                                class="w-full pl-10 pr-4 py-2.5 border-2 border-sage-200 rounded-full focus:outline-none focus:ring-2 focus:ring-sage-400 transition-all duration-300">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                    <!-- Tombol Tambah Produk -->
                    <a href="{{ route('createItemProduk') }}"
                        class="group inline-flex items-center gap-2 px-5 py-2.5 bg-sage-600 text-white font-semibold rounded-full hover:bg-sage-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="whitespace-nowrap">Tambah Produk</span>
                    </a>
                </div>
            </div>

            <!-- Tabel Data Produk Responsif -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-sage-100">
                        <thead class="bg-[#7eb17e]">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-black uppercase tracking-wider w-16">No</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-black uppercase tracking-wider w-20">Gambar</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider min-w-[150px]">Nama Produk</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider min-w-[120px] hidden md:table-cell">Merek</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider min-w-[200px] max-w-[300px] hidden lg:table-cell">Deskripsi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider min-w-[120px] hidden md:table-cell">Kategori</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-black uppercase tracking-wider min-w-[110px] hidden lg:table-cell">Harga Beli</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-black uppercase tracking-wider min-w-[110px] hidden md:table-cell">Harga Jual</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-black uppercase tracking-wider w-24 hidden sm:table-cell">Stok</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-black uppercase tracking-wider w-32 hidden sm:table-cell">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-black uppercase tracking-wider w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-sage-100">
                            @forelse ($items as $index => $item)
                                <tr class="hover:bg-sage-50 transition-colors duration-200 animate-fade-in-up"
                                    style="animation-delay: {{ $index * 50 }}ms;">
                                    <td class="px-4 py-4 text-center text-sm font-medium text-gray-700">
                                        {{ $index + $items->firstItem() }}
                                    </td>

                                    <!-- Gambar -->
                                    <td class="px-4 py-4">
                                        <div class="flex justify-center">
                                            @if ($item->gambar_produk)
                                                <img src="{{ asset('storage/' . $item->gambar_produk) }}"
                                                    alt="{{ $item->nama_produk }}"
                                                    class="w-14 h-14 object-cover rounded-lg shadow-sm">
                                            @else
                                                <div class="w-14 h-14 bg-sage-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-7 h-7 text-sage-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-4 py-4 text-left">
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->nama_produk }}</div>
                                    </td>

                                    <td class="px-4 py-4 text-left text-sm text-gray-700 hidden md:table-cell">
                                        {{ $item->merek }}
                                    </td>

                                    <td class="px-4 py-4 text-left text-sm text-gray-600 hidden lg:table-cell">
                                        <div class="line-clamp-2">{{ $item->deskripsi }}</div>
                                    </td>

                                    <td class="px-4 py-4 text-left text-sm text-gray-700 hidden md:table-cell">
                                        <span class="px-2 py-1 bg-sage-100 text-sage-800 rounded-md text-xs font-medium">
                                            {{ $item->category?->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-right text-sm font-medium text-gray-900 hidden lg:table-cell">
                                        Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-4 text-right text-sm font-semibold text-sage-700 hidden md:table-cell">
                                        Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-4 text-center hidden sm:table-cell">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full
                                            {{ $item->stok > 10 ? 'bg-green-100 text-green-800' : ($item->stok > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $item->stok }} Pcs
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-center hidden sm:table-cell">
                                        @php
                                            $statusClasses = [
                                                'tersedia' => 'bg-green-100 text-green-800',
                                                'tidak tersedia' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $statusClasses[$item->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('editItemProduk', $item->id) }}"
                                                class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200"
                                                title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('deleteItemProduk', $item->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors duration-200"
                                                    title="Delete"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                            <p class="text-gray-500 text-lg font-medium">Belum ada data produk</p>
                                            <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Produk" untuk menambahkan produk baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $items->appends(['search' => request('search')])->links() }}
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.classList.add('opacity-0', 'transition', 'duration-500');
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>

        <style>
            @keyframes fade-in {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes fade-in-up {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fade-in 0.5s ease-out;
            }

            .animate-fade-in-up {
                animation: fade-in-up 0.5s ease-out forwards;
                opacity: 0;
            }

            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>

    </div>
@endsection
