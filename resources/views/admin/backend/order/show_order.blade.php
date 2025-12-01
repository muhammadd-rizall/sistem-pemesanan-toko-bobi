@extends('admin.layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <!-- Alert Sukses -->
        @if (session('success'))
            <div id="success-alert"
                class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-md flex items-center justify-between"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm">{{ session('success') }}</span>
                </div>
                <button type="button" class="text-green-700 hover:text-green-900"
                    onclick="document.getElementById('success-alert').remove();">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-2xl p-8">

            <h3 class="text-3xl font-bold mb-8 text-gray-800 text-center border-b pb-4">
                Detail Order #{{ $order->invoice_number }}
            </h3>

            <!-- Info Pelanggan -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Info Pelanggan :</h2>

                <div class="border border-gray-200 rounded-xl p-4 bg-gray-50 shadow-sm">
                    <p class="text-sm text-gray-600">Nama :
                        <span class="text-gray-800">{{ $order->customer->name }}</span>
                    </p>

                    <p class="text-sm text-gray-600">Phone :
                        <span class="text-gray-800">{{ $order->no_hp }}</span>
                    </p>

                    <p class="text-sm text-gray-600">Alamat Pengiriman :
                        <span class="text-gray-800">{{ $order->alamat_pengiriman }}</span>
                    </p>
                </div>
            </div>

            {{-- catatan  --}}
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Note :</h2>
                <div class="border border-gray-200 rounded-xl p-4 bg-gray-50 shadow-sm">
                    <p class="text-sm text-gray-600">
                        {{ $order->catatan }}
                    </p>
                </div>
            </div>

            <!-- Item Pesanan -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-3">Item Pesanan :</h2>

                <div class="overflow-x-auto rounded-xl border border-gray-200">
                    <table class="min-w-full bg-white rounded-lg">
                        <thead class="bg-[#7eb17e] text-gray-900 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold">No</th>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold">Nama Produk</th>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold">Harga Satuan</th>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold">Jumlah</th>
                                <th class="py-2 px-4 border-b text-left text-sm font-semibold">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b text-sm">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4 border-b text-sm">{{ $item->product->nama_produk }}</td>
                                    <td class="py-2 px-4 border-b text-sm">
                                        Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                    </td>
                                    <td class="py-2 px-4 border-b text-sm">{{ $item->quantity }}</td>
                                    <td class="py-2 px-4 border-b text-sm">
                                        Rp. {{ number_format($item->harga_total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach

                            @if ($order->orderItems->isEmpty())
                                <tr>
                                    <td colspan="5" class="py-4 px-4 text-center text-sm text-gray-500">
                                        Tidak ada item dalam pesanan ini.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            @php
                $payment = $order->payment ?? null;
                $statusColor = [
                    'unpaid' => 'bg-red-500 text-white',
                    'pending' => 'bg-yellow-400 text-black',
                    'paid' => 'bg-green-500 text-white',
                    'failed' => 'bg-red-700 text-white',
                ];
            @endphp

            <div class="mb-8 border border-gray-300 rounded-xl p-6 shadow-sm bg-gray-50">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Ringkasan Pembayaran :</h2>

                <div class="grid grid-cols-1 gap-2">

                    <p class="text-sm text-gray-600">
                        Total Harga Awal :
                        <span class=" text-gray-800">
                            Rp. {{ number_format($order->total_harga_awal, 0, ',', '.') }}
                        </span>
                    </p>

                    <p class="text-sm text-gray-600">
                        Diskon :
                        <span class=" text-gray-800">
                            Rp. {{ number_format($order->total_diskon, 0, ',', '.') }}
                        </span>
                    </p>

                    <p class="text-sm text-gray-600">
                        Total Harga Akhir :
                        <span class=" text-gray-800">
                            Rp. {{ number_format($order->total_harga_akhir, 0, ',', '.') }}
                        </span>
                    </p>

                    <p class="text-sm text-gray-600">
                        Metode Pembayaran :
                        <span class=" text-gray-800">
                            {{ $payment ? strtoupper($payment->metode_pembayaran) : '-' }}
                        </span>
                    </p>

                    <p class="text-sm text-gray-600 flex items-center gap-2">
                        Status Pembayaran :
                        <span
                            class="px-3 py-1 rounded-full text-xs
                            {{ $payment ? $statusColor[$payment->pembayaran_status] ?? 'bg-gray-400 text-black' : 'bg-gray-300 text-black' }}">
                            {{ $payment ? ucfirst($payment->pembayaran_status) : 'Belum Dibayar' }}
                        </span>
                    </p>

                    <p class="text-sm text-gray-600">
                        Status Order :
                        <span class=" text-gray-800">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Form Update Status -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-3">Update Status Pengiriman :</h2>

                <form action="{{ route('updateOrderStatus', $order->id) }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <select name="status"
                        class="border border-gray-300 rounded-lg px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-green-400">
                        @foreach (['pending', 'proses', 'dikirim', 'selesai', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Tombol Back -->
            <div class="text-center mt-8">
                <a href="{{ route('listOrder') }}"
                    class="inline-block px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-semibold transition">
                    ← Kembali
                </a>
            </div>

        </div>

    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.classList.add('opacity-0', 'transition', 'duration-500');
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>
@endsection
