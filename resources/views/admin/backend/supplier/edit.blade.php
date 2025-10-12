@extends('admin.layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Edit Data Supplier</h3>

            <form action="{{ route('updateSupplier', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Perusahaan --}}
                <div class="mb-4">
                    <label for="nama_perusahaan" class="block text-sm font-medium text-gray-800">
                        Nama Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200
                    focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('nama_perusahaan') ? 'border-red-500' : '' }}"
                        value="{{ old('nama_perusahaan', $data->nama_perusahaan) }}" required>
                    @error('nama_perusahaan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kontak Person --}}
                <div class="mb-4">
                    <label for="kontak_person" class="block text-sm font-medium text-gray-800">
                        Kontak Person <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kontak_person" id="kontak_person"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200
                    focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('kontak_person') ? 'border-red-500' : '' }}"
                        value="{{ old('kontak_person', $data->kontak_person) }}" required>
                    @error('kontak_person')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No Telepon --}}
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-800">
                        No Telepon <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="phone" id="phone"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200
                    focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('phone') ? 'border-red-500' : '' }}"
                        value="{{ old('phone', $data->phone) }}" required>
                    @error('phone')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-800">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200
                    focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('email') ? 'border-red-500' : '' }}"
                        value="{{ old('email', $data->email) }}" required>
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Provinsi --}}
                <div class="mb-4">
                    <label for="provinsi" class="block text-sm font-medium text-gray-800">
                        Provinsi
                    </label>
                    <input type="text" name="provinsi" id="provinsi"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200
                    focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('provinsi') ? 'border-red-500' : '' }}"
                        value="{{ old('provinsi', $data->provinsi) }}" required>
                    @error('provinsi')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kota/Kabupaten --}}
                <div class="mb-4">
                    <label for="kota" class="block text-sm font-medium text-gray-800">
                        Kota/Kabupaten
                    </label>
                    <input type="text" name="kota" id="kota"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200
                    focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('kota') ? 'border-red-500' : '' }}"
                        value="{{ old('kota', $data->kota) }}" required>
                    @error('kota')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kecamatan --}}
                <div class="mb-4">
                    <label for="kecamatan" class="block text-sm font-medium text-gray-800">
                        Kecamatan
                    </label>
                    <input type="text" name="kecamatan" id="kecamatan"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200
                    focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('kecamatan') ? 'border-red-500' : '' }}"
                        value="{{ old('kecamatan', $data->kecamatan) }}" required>
                    @error('kecamatan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-800">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="alamat" id="alamat"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200
                    focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('alamat') ? 'border-red-500' : '' }}"
                        value="{{ old('alamat', $data->alamat) }}" required>
                    @error('alamat')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-800">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                        class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200
        focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('status') ? 'border-red-500' : '' }}"
                        required>
                        <option value="active" {{ old('status', $data->status) == 'active' ? 'selected' : '' }}>Active
                        </option>
                        <option value="inactive" {{ old('status', $data->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive</option>
                    </select>
                    @error('status')
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
