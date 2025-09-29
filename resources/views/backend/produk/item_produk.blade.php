@extends('admin.layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Item Produk</h1>
        <a href="#"
            class="inline-block mb-6 bg-[#6F9679] hover:bg-[#5a7a62] text-white font-medium px-4 py-2 rounded-md shadow transition duration-200">Tambah
            Item Produk</a>

            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-[#6F9679] text-black uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-center font-medium">No</th>
                            <th class="px-6 py-3 text-center font-medium">Nama Produk</th>
                            <th class="px-6 py-3 text-center font-medium">Deskripsi</th>
                            <th class="px-6 py-3 text-center font-medium">Harga</th>
                            <th class="px-6 py-3 text-center font-medium">Stok</th>
                            <th class="px-6 py-3 text-center font-medium">Gambar</th>
                            <th class="px-6 py-3 text-center font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($items as $index => $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-center font-medium">{{ $index * $items->firstItem() }}</td>
                                <td class="px-6 py-4 text-center font-medium">{{ $item->nama_produk }}</td>
                                <td class="px-6 py-4 text-center font-medium">{{ $item->deskripsi }}</td>
                                <td class="px-6 py-4 text-center font-medium">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center font-medium">{{ $item->stok }}</td>
                                <td class="px-6 py-4 text-center font-medium">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}"
                                            class="w-16 h-16 object-cover mx-auto rounded">
                                    @else
                                        <span class="text-gray-500">No Image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="#"
                                        class="text-blue-600 hover:text-blue-900 font-medium mr-2">Edit</a>
                                    <form action="#" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 font-medium"
                                            onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
    </div>
@endsection
