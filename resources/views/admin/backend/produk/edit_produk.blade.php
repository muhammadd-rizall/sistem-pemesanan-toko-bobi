@extends('admin.layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Input Item Produk</h3>
            <form action="{{ route('updateItemProduk', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- nama barang --}}
                <div class="mb-4">
                    <label for="nama_produk" class="block text-sm font-medium text-gray-800">
                        Nama produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_produk" id="nama_produk"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('nama_produk') ? 'border-red-500' : '' }}"
                        value="{{ $item->nama_produk }}" required>
                    @error('nama_produk')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- deskripsi --}}
                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-800">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="deskripsi" id="deskripsi"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('deskripsi') ? 'border-red-500' : '' }}"
                        value="{{ $item->deskripsi }}" required>
                    @error('deskripsi')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- harga --}}
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-800">
                        Harga <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="harga" id="harga"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('harga') ? 'border-red-500' : '' }}"
                        value="{{ $item->harga }}" required>
                    @error('harga')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- stok --}}
                <div class="mb-4">
                    <label for="stok" class="block text-sm font-medium text-gray-800">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="stok" id="stok"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('stok') ? 'border-red-500' : '' }}"
                        value="{{ $item->stok }}" required>
                    @error('stok')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label for="gambar_produk" class="block text-sm font-medium text-gray-800">
                        Gambar Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="gambar_produk" id="gambar_produk"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('gambar_produk') ? 'border-red-500' : '' }}">
                    @error('gambar_produk')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    @if ($item->gambar_produk)
                        <div class="mt-2">
                            <strong>Gambar saat ini:</strong><br>
                            <img src="{{ asset('storage/' . $item->gambar_produk) }}"
                                alt="Gambar {{ $item->name_produk }}" class="rounded-lg shadow-md border border-gray-200"
                                width="150">
                        </div>
                    @endif
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-between">
                    <a href="{{ route('produk_view') }}"
                        class="inline-block px-4 py-2 bg-[#a8c9a8] text-black rounded-md hover:bg-[#7eb17e] transition">
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
