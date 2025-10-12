@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="bg-white rounded-3xl shadow-2xl p-8">
        <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Input Data Diskon</h3>

        <form action="{{ route('storeDiskon') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Kode Diskon --}}
            <div class="mb-4">
                <label for="kode_diskon" class="block text-sm font-medium text-gray-800">
                    Kode DIskon <span class="text-red-500">*</span>
                </label>
                <input type="text" name="kode_diskon" id="kode_diskon"
                    class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('kode_diskon') ? 'border-red-500' : '' }}"
                    value="{{ old('kode_diskon') }}" required>
                @error('kode_diskon')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- nilai diskon --}}
            <div class="mb-4">
                <label for="nilai_diskon" class="block text-sm font-medium text-gray-800">
                    Nilai Diskon <span class="text-red-500">*</span>
                </label>
                <input type="number" name="nilai_diskon" id="nilai_diskon"
                    class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('nilai_diskon') ? 'border-red-500' : '' }}"
                    value="{{ old('nilai_diskon') }}" required>
                @error('nilai_diskon')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal mulai --}}
            <div class="mb-4">
                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-800">
                    No Telepon <span class="text-red-500">*</span>
                </label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                    class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('tanggal_mulai') ? 'border-red-500' : '' }}"
                    value="{{ old('tanggal_mulai') }}" required>
                @error('tanggal_mulai')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- tanggal berakhir --}}
            <div class="mb-4">
                <label for="tanggal_berakhir" class="block text-sm font-medium text-gray-800">
                    Tanggal Berakhir <span class="text-red-500">*</span>
                </label>
                <input type="date" name="tanggal_berakhir" id="tanggal_berakhir"
                    class="mt-2 block w-full border border-gray-500 text-black focus:border-blue-300 focus:ring-blue-200 focus:ring focus:outline-none rounded-md py-2 px-2 {{ $errors->has('tanggal_berakhir') ? 'border-red-500' : '' }}"
                    value="{{ old('tanggal_berakhir') }}" required>
                @error('tanggal_berakhir')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between">
                <a href="{{ route('diskonView') }}"
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
