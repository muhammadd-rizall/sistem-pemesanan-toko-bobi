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
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 18L18 6M6 6l12 12" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    <div class="animate-fade-in">
        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-sage-800">Manajemen Supplier</h1>
                <p class="text-sage-600 mt-1">Kelola semua data supplier di toko Anda.</p>
            </div>
            <div class="flex items-center gap-4 w-full sm:w-auto">
                <!-- Search Bar -->
                <form action="{{ route('supplierView') }}" method="GET">
                    <div class="relative w-full sm:w-64">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari supplier..."
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-sage-200 rounded-full focus:outline-none focus:ring-2 focus:ring-sage-400 transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </form>

                <!-- Tombol Tambah Supplier -->
                <a href="{{ route('createSupplier') }}"
                    class="group inline-flex items-center gap-2 px-5 py-2.5 bg-sage-600 text-white font-semibold rounded-full hover:bg-sage-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="whitespace-nowrap">Tambah Supplier</span>
                </a>
            </div>
        </div>

        <!-- Tabel Data Supplier -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-max w-full text-sm sm:text-base divide-y divide-sage-100">
                    <thead class="bg-[#7eb17e] text-black uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center font-bold">No</th>
                            <th class="px-4 py-3 text-center font-bold">Nama Perusahaan</th>
                            <th class="px-4 py-3 text-center font-bold">Kontak Person</th>
                            <th class="px-4 py-3 text-center font-bold">No Telepon</th>
                            <th class="px-4 py-3 text-center font-bold">Email</th>
                            <th class="px-4 py-3 text-center font-bold">Provinsi</th>
                            <th class="px-4 py-3 text-center font-bold">Kota</th>
                            <th class="px-4 py-3 text-center font-bold">Kecamatan</th>
                            <th class="px-4 py-3 text-center font-bold">Alamat</th>
                            <th class="px-4 py-3 text-center font-bold">Status</th>
                            <th class="px-4 py-3 text-center font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sage-100">
                        @forelse ($datas as $index => $data)
                            <tr class="hover:bg-sage-50 transition duration-200">
                                <td class="px-4 py-3 text-center">{{ $index + $datas->firstItem() }}</td>
                                <td class="px-4 py-3 text-center">{{ $data->nama_perusahaan }}</td>
                                <td class="px-4 py-3 text-center">{{ $data->kontak_person }}</td>
                                <td class="px-4 py-3 text-center">{{ $data->phone }}</td>
                                <td class="px-4 py-3 text-center">{{ $data->email }}</td>
                                <td class="px-4 py-3 text-center">{{ $data->provinsi }}</td>
                                <td class="px-4 py-3 text-center">{{ $data->kota }}</td>
                                <td class="px-4 py-3 text-center">{{ $data->kecamatan }}</td>
                                <td class="px-4 py-3 text-center">{{ $data->alamat }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full {{ $data->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $data->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('editSupplier', $data->id) }}"
                                            class="p-2 text-blue-600 hover:bg-blue-100 rounded-full transition duration-200"
                                            title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('deleteSupplier', $data->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-100 rounded-full transition duration-200"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-10 text-gray-500">
                                    <p>Belum ada data supplier.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $datas->appends(['search' => request('search')])->links() }}
        </div>
    </div>
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
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in { animation: fade-in 0.5s ease-out; }
</style>
@endsection
