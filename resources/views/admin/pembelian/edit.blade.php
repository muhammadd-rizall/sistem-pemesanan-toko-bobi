@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="bg-white rounded-3xl shadow-2xl p-8">
        <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">
            Edit Pembelian
        </h3>

        <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Tanggal --}}
            <div class="mb-4">
                <label for="tanggal" class="block text-sm font-medium text-gray-800">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <input
                    type="date"
                    name="tanggal"
                    id="tanggal"
                    value="{{ old('tanggal', $pembelian->tanggal->format('Y-m-d')) }}"
                    class="mt-2 block w-full border border-gray-500 rounded-md px-3 py-2 text-black
                        focus:ring focus:ring-blue-200 focus:border-blue-300
                        {{ $errors->has('tanggal') ? 'border-red-500' : '' }}"
                    required
                >
                @error('tanggal')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Produk --}}
            <div class="mb-4">
                <label for="produk_id" class="block text-sm font-medium text-gray-800">
                    Produk <span class="text-red-500">*</span>
                </label>
                <select
                    name="produk_id"
                    id="produk_id"
                    class="mt-2 block w-full border border-gray-500 rounded-md px-3 py-2 text-black
                        focus:ring focus:ring-blue-200 focus:border-blue-300
                        {{ $errors->has('produk_id') ? 'border-red-500' : '' }}"
                    required
                >
                    <option value="" disabled>Pilih Produk</option>
                    @foreach ($produkList as $produk)
                        <option value="{{ $produk->id }}"
                            {{ $pembelian->produk_id == $produk->id ? 'selected' : '' }}>
                            {{ $produk->nama_produk ?? $produk->nama }}
                        </option>
                    @endforeach
                </select>
                @error('produk_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Supplier --}}
            <div class="mb-4">
                <label for="supplier_id" class="block text-sm font-medium text-gray-800">
                    Supplier <span class="text-red-500">*</span>
                </label>
                <select
                    name="supplier_id"
                    id="supplier_id"
                    class="mt-2 block w-full border border-gray-500 rounded-md px-3 py-2 text-black
                        focus:ring focus:ring-blue-200 focus:border-blue-300
                        {{ $errors->has('supplier_id') ? 'border-red-500' : '' }}"
                    required
                >
                    <option value="" disabled>Pilih Supplier</option>
                    @foreach ($supplierList as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ $pembelian->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->nama_perusahaan }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah --}}
            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-medium text-gray-800">
                    Jumlah <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    name="jumlah"
                    id="jumlah"
                    value="{{ old('jumlah', $pembelian->jumlah) }}"
                    class="mt-2 block w-full border border-gray-500 rounded-md px-3 py-2 text-black
                        focus:ring focus:ring-blue-200 focus:border-blue-300
                        {{ $errors->has('jumlah') ? 'border-red-500' : '' }}"
                    required
                >
                @error('jumlah')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga Satuan --}}
            <div class="mb-4">
                <label for="harga_satuan" class="block text-sm font-medium text-gray-800">
                    Harga Satuan <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    name="harga_satuan"
                    id="harga_satuan"
                    value="{{ old('harga_satuan', $pembelian->harga_satuan) }}"
                    class="mt-2 block w-full border border-gray-500 rounded-md px-3 py-2 text-black
                        focus:ring focus:ring-blue-200 focus:border-blue-300
                        {{ $errors->has('harga_satuan') ? 'border-red-500' : '' }}"
                    required
                >
                @error('harga_satuan')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="mb-6">
                <label for="keterangan" class="block text-sm font-medium text-gray-800">
                    Keterangan
                </label>
                <textarea
                    name="keterangan"
                    id="keterangan"
                    rows="4"
                    class="mt-2 block w-full border border-gray-500 rounded-md px-3 py-2 text-black
                        focus:ring focus:ring-blue-200 focus:border-blue-300
                        {{ $errors->has('keterangan') ? 'border-red-500' : '' }}"
                >{{ old('keterangan', $pembelian->keterangan) }}</textarea>
                @error('keterangan')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between">
                <a href="{{ route('pembelian.index') }}"
                    class="px-4 py-2 bg-[#a8c9a8] text-black rounded-md hover:bg-[#7eb17e] transition">
                    Kembali
                </a>

                <button type="submit"
                    class="px-6 py-2 bg-[#5f9964] text-black rounded-md hover:bg-[#6F9679] transition">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
