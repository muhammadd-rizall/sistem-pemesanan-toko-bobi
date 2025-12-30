@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="bg-white rounded-3xl shadow-2xl p-8">

        <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">
            Edit Data Kategori
        </h3>

        <form action="{{ route('updateCategory', $data->id) }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-800">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name"
                    class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2
                    {{ $errors->has('name') ? 'border-red-500' : '' }}"
                    value="{{ old('name', $data->name) }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-800">
                    Deskripsi
                </label>
                <textarea name="description" rows="4"
                    class="mt-2 block w-full border border-gray-500 rounded-md py-2 px-2">{{ old('description', $data->description) }}</textarea>
            </div>

            {{-- Aksi --}}
            <div class="flex justify-between">
                <a href="{{ route('categoryView') }}"
                    class="px-4 py-2 bg-[#a8c9a8] rounded-md hover:bg-[#7eb17e]">
                    Kembali
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-[#5f9964] rounded-md hover:bg-[#6F9679]">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
