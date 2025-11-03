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

                {{-- merek --}}
                <div class="mb-4">
                    <label for="merek" class="block text-sm font-medium text-gray-800">
                        Merek
                    </label>
                    <input type="text" name="merek" id="merek"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('merek') ? 'border-red-500' : '' }}"
                        value="{{ $item->merek }}" required>
                    @error('merek')
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

                {{-- kategories --}}
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-800">
                        Kategories <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" id="category_id"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('category_id') ? 'border-red-500' : '' }}"
                        required>
                        <option value="" disabled>Pilih Kategories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Supplier --}}
                <div class="mb-4">
                    <label for="supplier_id" class="block text-sm font-medium text-gray-800">
                        Supplier <span class="text-red-500">*</span>
                    </label>
                    <select name="supplier_id" id="supplier_id"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('supplier_id') ? 'border-red-500' : '' }}"
                        required>
                        <option value="" disabled>Pilih Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ $item->supplier_id == $supplier->id ? 'selected' : '' }}> {{-- UBAH LOGIKA 'SELECTED' DI SINI --}}
                                {{ $supplier->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- harga beli --}}
                <div class="mb-4">
                    <label for="harga_beli" class="block text-sm font-medium text-gray-800">
                        Harga Beli <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="harga_beli" id="harga_beli"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('harga_beli') ? 'border-red-500' : '' }}"
                        value="{{ $item->harga_beli }}" required>
                    @error('harga_beli')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- harga jual --}}
                <div class="mb-4">
                    <label for="harga_jual" class="block text-sm font-medium text-gray-800">
                        Harga Jual<span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="harga_jual" id="harga_jual"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('harga_jual') ? 'border-red-500' : '' }}"
                        value="{{ $item->harga_jual }}" required>
                    @error('harga_jual')
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

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-800">Status <span
                            class="text-red-500">*</span></label>
                    <div class="flex items-center space-x-8 mt-2">
                        <label class="inline-flex items-center space-x-2">
                            <input class="text-black focus:ring-blue-200" type="radio" name="status" value="tersedia"
                                {{ $item->status == 'tersedia' ? 'checked' : '' }} required>
                            <span class="text-black text-sm">Tesedia</span>
                        </label>

                        <label class="inline-flex items-center space-x-2">
                            <input class="text-black focus:ring-blue-200" type="radio" name="status" value="tidak tersedia"
                                {{ $item->status == 'tidak tersedia' ? 'checked' : '' }} required>
                            <span class="text-black text-sm">Tidak Tersedia</span>
                        </label>
                    </div>
                    @error('status')
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
