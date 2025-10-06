@extends('admin.layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Input Data Supplier</h3>
            <form action="{{ route('updateSupplier', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- nama perusahaan --}}
                <div class="mb-4">
                    <label for="nama_perusahaan" class="block text-sm font-medium text-gray-800">
                        Nama Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('nama_perusahaan') ? 'border-red-500' : '' }}"
                        value="{{ $data->nama_perusahaan }}" required>
                    @error('nama_perusahaan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- kontak person --}}
                <div class="mb-4">
                    <label for="kontak_person" class="block text-sm font-medium text-gray-800">
                        Kontak Person <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kontak_person" id="kontak_person"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('kontak_person') ? 'border-red-500' : '' }}"
                        value="{{ $data->kontak_person }}" required>
                    @error('kontak_person')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- phone --}}
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-800">
                        No Telephone <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="phone" id="phone"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('phone') ? 'border-red-500' : '' }}"
                        value="{{ $data->phone }}" required>
                    @error('phone')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-800">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="email" id="email"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('email') ? 'border-red-500' : '' }}"
                        value="{{ $data->email }}" required>
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- provinsi --}}
                <div class="mb-4">
                    <label for="provinsi" class="block text-sm font-medium text-gray-800">
                        Provinsi
                    </label>
                    <input type="text" name="provinsi" id="provinsi"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('provinsi') ? 'border-red-500' : '' }}"
                        value="{{ $data->provinsi }}" required>
                    @error('provinsi')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>



                {{-- kota/kabupaten --}}
                <div class="mb-4">
                    <label for="kota" class="block text-sm font-medium text-gray-800">
                        Kota/kabupaten
                    </label>
                    <input type="text" name="kota" id="kota"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('kota') ? 'border-red-500' : '' }}"
                        value="{{ $data->kota }}" required>
                    @error('kota')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- kecamatan --}}
                <div class="mb-4">
                    <label for="kecamatan" class="block text-sm font-medium text-gray-800">
                        Kecamatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kecamatan" id="kecamatan"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('kecamatan') ? 'border-red-500' : '' }}"
                        value="{{ $data->kecamatan }}" required>
                    @error('kecamatan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- alamat --}}
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-800">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="alamat" id="alamat"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('alamat') ? 'border-red-500' : '' }}"
                        value="{{ $data->alamat }}" required>
                    @error('alamat')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Tombol Aksi --}}
                <div class="flex justify-between">
                    <a href="{{ route('supplierView') }}"
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
