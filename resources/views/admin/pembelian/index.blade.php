@extends('admin.layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto">

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
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Laporan Pembelian</h1>
                <p class="text-gray-500">Catat dan pantau pembelian produk dari supplier</p>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Total Pembelian</p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                Rp {{ number_format($totalPembelian, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600">💰
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Total Transaksi</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $totalTransaksi }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">📈
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Produk Dibeli</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $produkDibeli }} pcs</h3>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600">📦
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Rata-rata Transaksi</p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">📅
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Action -->
            <div
                class="bg-white rounded-xl p-5 mb-6 border border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <form method="GET" action="{{ route('pembelian.index') }}" class="w-full sm:w-auto">
                    <select name="filter" onchange="this.form.submit()"
                        class="w-full px-4 py-2 border rounded-lg bg-gray-50">
                        <option value="semua">Semua</option>
                        <option value="hari_ini">Hari Ini</option>
                        <option value="minggu_ini">Minggu Ini</option>
                        <option value="bulan_ini">Bulan Ini</option>
                        <option value="tahun_ini">Tahun Ini</option>
                    </select>
                </form>

                <div class="flex gap-3 w-full sm:w-auto">
                    <button onclick="openModal()"
                        class="w-full sm:w-auto px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium">
                        + Tambah Pembelian
                    </button>

                    <a href="{{ route('pembelian.export', ['filter' => $filter]) }}"
                        class="w-full sm:w-auto text-center px-5 py-2.5 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg font-medium">
                        Ekspor CSV
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
                <div class="p-6 border-b">
                    <h2 class="text-lg font-semibold">Data Pembelian</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500">KODE</th>
                                <th class="hidden md:table-cell px-6 py-3 text-xs font-semibold text-gray-500">TANGGAL</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500">PRODUK</th>
                                <th class="hidden md:table-cell px-6 py-3 text-xs font-semibold text-gray-500">SUPPLIER</th>
                                <th class="hidden sm:table-cell px-6 py-3 text-xs font-semibold text-gray-500">JUMLAH</th>
                                <th class="hidden sm:table-cell px-6 py-3 text-xs font-semibold text-gray-500">HARGA</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500">TOTAL</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($pembelian as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm">{{ $item->kode_pembelian }}</td>
                                    <td class="hidden md:table-cell px-6 py-4 text-sm">{{ $item->tanggal->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $item->produk->nama_produk ?? '-' }}</td>
                                    <td class="hidden md:table-cell px-6 py-4 text-sm">{{ $item->supplier->nama_perusahaan ?? '-' }}</td>
                                    <td class="hidden sm:table-cell px-6 py-4 text-sm">{{ $item->jumlah }} pcs</td>
                                    <td class="hidden sm:table-cell px-6 py-4 text-sm">
                                        Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-green-600">
                                        Rp {{ number_format($item->total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('pembelian.edit', $item->id) }}"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl w-11/12 max-w-md p-6 mx-auto">
            <h3 class="text-xl font-semibold mb-4">Tambah Pembelian</h3>

            <form method="POST" action="{{ route('pembelian.store') }}">
                @csrf

                <div class="space-y-3">
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required
                        class="w-full border px-4 py-2 rounded-lg">

                    <select name="produk_id" required class="w-full border px-4 py-2 rounded-lg">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($produkList as $produk)
                            <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                        @endforeach
                    </select>

                    <select name="supplier_id" required class="w-full border px-4 py-2 rounded-lg">
                        <option value="">-- Pilih Supplier --</option>
                        @foreach ($supplierList as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama_perusahaan }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="jumlah" placeholder="Jumlah" required
                        class="w-full border px-4 py-2 rounded-lg">
                    <input type="number" name="harga_satuan" placeholder="Harga Satuan" required
                        class="w-full border px-4 py-2 rounded-lg">
                    <input type="text" name="keterangan" placeholder="Keterangan (opsional)"
                        class="w-full border px-4 py-2 rounded-lg">
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeModal()" class="flex-1 border rounded-lg py-2">Batal</button>
                    <button class="flex-1 bg-green-600 text-white rounded-lg py-2">Simpan</button>
                </div>
            </form>
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

    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
@endsection
