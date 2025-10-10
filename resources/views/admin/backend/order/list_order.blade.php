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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- Container utama dengan animasi fade-in saat halaman dimuat --}}
        <div class="animate-fade-in">

            <!-- Header Halaman: Judul, Tombol Aksi, dan Search Bar -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-sage-800">Manajemen Order</h1>
                    <p class="text-sage-600 mt-1">Kelola semua item Order di toko Anda.</p>
                </div>
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <!-- Search Bar -->
                    <form action="{{ route('listOrder') }}" method="GET">
                        <div class="relative w-full sm:w-64">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari Order..."
                                class="w-full pl-10 pr-4 py-2.5 border-2 border-sage-200 rounded-full focus:outline-none focus:ring-2 focus:ring-sage-400 transition-all duration-300">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Data order -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table-fixed w-full divide-y divide-sage-100">
                        <thead class="bg-[#7eb17e] text-black uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-4 text-center font-bold w-[5%]">No</th>
                                <th class="px-2 py-4 text-center font-bold w-[20%]">Customer</th>
                                <th class="px-6 py-4 text-center font-bold w-[20%]">Harga Awal</th>
                                <th class="px-6 py-4 text-center font-bold w-[30%]">Diskon</th>
                                <th class="px-6 py-4 text-center font-bold w-[20%]">Total Diskon</th>
                                <th class="px-6 py-4 text-center font-bold w-[20%]">Harga Akhir</th>
                                <th class="px-6 py-4 text-center font-bold w-[20%]">Status</th>
                                <th class="px-6 py-4 text-center font-bold w-[15%]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sage-100">
                            @forelse ($orders as $index => $order)
                                <tr class="hover:bg-sage-50/50 transition-colors duration-200 animate-fade-in-up"
                                    style="animation-delay: {{ $index * 50 }}ms;">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 text-center">
                                        {{ $index + $orders->firstItem() }}
                                    </td>

                                    <!--Nama -->
                                    <td class="px-6 py-4 text-center font-semibold align-top">
                                        <p class="text-sm text-gray-600">{{ $order->customer->name }}</p>
                                    </td>

                                    <!--Harga awal -->
                                    <td class="px-6 py-4 text-center align-top text-sm font-semibold text-sage-700">
                                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                    </td>

                                    <!--Diskon -->
                                    <td class="px-6 py-4 text-center font-semibold align-top">
                                        <p class="text-sm text-gray-600">{{ $order->diskon_id }}</p>
                                    </td>

                                    <!-- harga diskon  -->
                                    <td class="px-6 py-4 text-center align-top text-sm font-semibold text-sage-700">
                                        Rp {{ number_format($order->total_diskon, 0, ',', '.') }}
                                    </td>

                                    <!-- harga akhir  -->
                                    <td class="px-6 py-4 text-center align-top text-sm font-semibold text-sage-700">
                                        Rp {{ number_format($order->harga_akhir, 0, ',', '.') }}
                                    </td>

                                    <!-- status  -->
                                    <td class="px-6 py-4 text-center align-top text-sm font-semibold text-sage-700">
                                        <div class="px-4 py-4">
                                            @if ($order->status == 'pending')
                                                <span
                                                    class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Pending</span>
                                            @elseif ($order->status == 'processing')
                                                <span
                                                    class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Processing</span>
                                            @elseif ($order->status == 'shipped')
                                                <span
                                                    class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Shipped</span>
                                            @elseif ($order->status == 'delivered')
                                                <span
                                                    class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">Delivered</span>
                                            @else
                                                <span
                                                    class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">Cancelled</span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Kolom Aksi -->
                                    <td class="px-6 py-4 text-center align-top text-sm font-medium">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('editItemProduk', $order->id) }}"
                                                class="p-2 text-blue-600 hover:bg-blue-100 rounded-full transition-colors duration-200"
                                                title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('deleteItemProduk', $order->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-red-600 hover:bg-red-100 rounded-full transition-colors duration-200"
                                                    title="Delete"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                            <a href="{{ route('detailOrder', $order->id) }}"
                                                class="p-2 text-yellow-600 hover:bg-yellow-100 rounded-full transition-colors duration-200"
                                                title="Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-10 text-gray-500">
                                        <p>Belum ada data produk.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $orders->appends(['search' => request('search')])->links() }}
    </div>

    <script>
        setTimeout(function() {
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
    </style>
@endsection
