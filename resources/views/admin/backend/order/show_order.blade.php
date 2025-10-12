@extends('admin.layouts.app')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="bg-white rounded-3xl shadow-2xl p-8">
        <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Detail Order #{{ $order->id }}</h3>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-700">Info Pelanggan :</h2>
            <p class="text-sm text-gray-500">Nama : {{ $order->customer->name }}</p>
            <p class="text-sm text-gray-500">Phone : {{ $order->customer->phone }}</p>
            <p class="text-sm text-gray-500">Alamat Pengiriman : {{ $order->alamat_pengiriman }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Item Pesanan :</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">No</th>
                            <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Nama Produk</th>
                            <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Harga Satuan</th>
                            <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Jumlah</th>
                            <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $item->produk->nama_produk }}</td>
                                <td class="py-2 px-4 border-b text-sm text-gray-700">Rp. {{ number_format($item->harga_satuan,0,',','.') }}</td>
                                <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $item->quantity }}</td>
                                <td class="py-2 px-4 border-b text-sm text-gray-700">Rp. {{ number_format($item->harga_total,0,',','.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-700">Ringkasan Pembayaran :</h2>
            <p class="text-sm text-gray-500">Total Harga : Rp. {{ number_format($item->harga_total,0,',','.') }}</p>
            <p class="text-sm text-gray-500">Diskon : Rp. {{ number_format($order->total_diskon,0,',','.') }}</p>
            <p class="text-sm text-gray-500">Harga Akhir : Rp. {{ number_format($order->harga_akhir,0,',','.') }}</p>
            <p class="text-sm text-gray-500">Status Pembayaran : {{ ucfirst($order->status) }}</p>
        </div>
    </div>
</div>
@endsection
