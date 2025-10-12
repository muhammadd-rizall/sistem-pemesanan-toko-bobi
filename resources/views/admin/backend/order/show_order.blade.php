@extends('admin.layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center">Detail Order #{{ $order->id }}</h3>

            <!-- Info Pelanggan -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700">Info Pelanggan :</h2>
                <p class="text-sm text-gray-500">Nama : {{ $order->customer->name }}</p>
                <p class="text-sm text-gray-500">Phone : {{ $order->customer->phone }}</p>
                <p class="text-sm text-gray-500">Alamat Pengiriman : {{ $order->alamat_pengiriman }}</p>
            </div>

            <!-- Item Pesanan -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Item Pesanan :</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-[#7eb17e] text-gray-900 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">No</th>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Nama Produk
                                </th>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Harga Satuan
                                </th>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Jumlah</th>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">Total Harga
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $item->produk->nama_produk }}
                                    </td>
                                    <td class="py-2 px-4 border-b text-sm text-gray-700">Rp.
                                        {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $item->quantity }}</td>
                                    <td class="py-2 px-4 border-b text-sm text-gray-700">Rp.
                                        {{ number_format($item->harga_total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            @if ($order->orderItems->isEmpty())
                                <tr>
                                    <td colspan="5" class="py-4 px-4 text-center text-sm text-gray-500">Tidak ada item
                                        dalam pesanan ini.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700">Ringkasan Pembayaran :</h2>
                <p class="text-sm text-gray-500">Total Harga Awal: Rp.
                    {{ number_format($order->total_harga_awal, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Diskon : Rp. {{ number_format($order->total_diskon, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Total Harga Akhir : Rp.
                    {{ number_format($order->total_harga_akhir, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Status Pembayaran : {{ ucfirst($order->status) }}</p>
            </div>

            <!-- Form Update Status -->
            <div class="mb-4">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Update Status Pengiriman :</h2>
                <form action="{{ route('updateOrderStatus', $order->id) }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <select name="status"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                        @foreach (['pending', 'proses', 'dikirim', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                        Update Status
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
