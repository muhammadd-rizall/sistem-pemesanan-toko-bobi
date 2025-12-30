@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-1">Laporan Pembelian</h1>
            <p class="text-gray-500">Catat dan pantau pembelian produk dari supplier</p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Pembelian</p>
                        <h3 class="text-2xl font-bold text-gray-900">
                            Rp {{ number_format($totalPembelian, 0, ',', '.') }}
                        </h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600">💰</div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Transaksi</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $totalTransaksi }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">📈</div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Produk Dibeli</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $produkDibeli }} pcs</h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600">📦</div>
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
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">📅</div>
                </div>
            </div>
        </div>

        <!-- Filter & Action -->
        <div class="bg-white rounded-xl p-5 mb-6 border border-gray-100 flex justify-between items-center">
            <form method="GET" action="{{ route('pembelian.index') }}">
                <select name="filter" onchange="this.form.submit()"
                    class="px-4 py-2 border rounded-lg bg-gray-50">
                    <option value="semua">Semua</option>
                    <option value="hari_ini">Hari Ini</option>
                    <option value="minggu_ini">Minggu Ini</option>
                    <option value="bulan_ini">Bulan Ini</option>
                    <option value="tahun_ini">Tahun Ini</option>
                </select>
            </form>

            <div class="flex gap-3">
                <button onclick="openModal()"
                    class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium">
                    + Tambah Pembelian
                </button>

                <a href="{{ route('pembelian.export', ['filter' => $filter]) }}"
                   class="px-5 py-2.5 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg font-medium">
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
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500">TANGGAL</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500">PRODUK</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500">JUMLAH</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500">HARGA</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500">TOTAL</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($pembelian as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">{{ $item->kode_pembelian }}</td>
                            <td class="px-6 py-4 text-sm">{{ $item->tanggal->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm">{{ $item->produk->nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">{{ $item->jumlah }} pcs</td>
                            <td class="px-6 py-4 text-sm">
                                Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-green-600">
                                Rp {{ number_format($item->total, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
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
    <div class="bg-white rounded-xl w-full max-w-md p-6">
        <h3 class="text-xl font-semibold mb-4">Tambah Pembelian</h3>

        <form method="POST" action="{{ route('pembelian.store') }}">
            @csrf

            <div class="space-y-3">
                <input type="date" name="tanggal" required class="w-full border px-4 py-2 rounded-lg">
                <input type="number" name="jumlah" placeholder="Jumlah" required class="w-full border px-4 py-2 rounded-lg">
                <input type="number" name="harga_satuan" placeholder="Harga Satuan" required class="w-full border px-4 py-2 rounded-lg">
            </div>

            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeModal()"
                    class="flex-1 border rounded-lg py-2">Batal</button>
                <button class="flex-1 bg-green-600 text-white rounded-lg py-2">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modal').classList.remove('hidden');
}
function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endsection
