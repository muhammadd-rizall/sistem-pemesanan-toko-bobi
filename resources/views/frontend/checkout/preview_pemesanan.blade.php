@extends('frontend.layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50 py-12 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Rincian Pesanan</h1>

            <div class="space-y-4">
                <!-- List Items -->
                <div class="flex flex-col gap-4">
                    @foreach ($order->orderItems as $item)
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ asset('storage/' . ($item->product?->gambar_produk ?? 'default.png')) }}"
                                alt="{{ $item->product?->nama_produk ?? 'Produk tidak tersedia' }}"
                                class="w-24 h-24 object-cover rounded-lg">
                            <div>
                                <h2 class="font-semibold text-lg">{{ $item->product?->nama_produk ?? '-' }}</h2>
                                <p>Harga: Rp {{ number_format($item->harga_satuan, 0, ',', '.') }} /pcs</p>
                                <p>Jumlah: {{ $item->quantity }}</p>
                                <p>Subtotal: Rp {{ number_format($item->harga_total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Informasi Pengiriman -->
                <div class="border-t pt-4">
                    <h3 class="font-semibold text-gray-700">Informasi Pengiriman</h3>
                    <p>Nama Customer: {{ $order->customer->name }}</p>
                    <p>Nomor Hp: {{ $order->no_hp }}</p>
                    <p>Alamat: {{ $order->alamat_pengiriman }}</p>
                    <p>Catatan: {{ $order->catatan ?? '-' }}</p>
                </div>

                <!-- Ringkasan Harga & Status -->
                <div class="border-t pt-4 space-y-2">
                    <h3 class="font-semibold text-gray-700">Ringkasan Harga</h3>
                    <p>Total Harga Awal: Rp {{ number_format($order->total_harga_awal, 0, ',', '.') }}</p>
                    <p>Total Diskon: Rp {{ number_format($order->total_diskon, 0, ',', '.') }}</p>
                    <p class="text-2xl font-bold text-green-600">Total Akhir: Rp
                        {{ number_format($order->total_harga_akhir, 0, ',', '.') }}</p>

                    <p>Status Pesanan:
                        <strong
                            class="@if ($order->status == 'pending') text-yellow-600
                                   @elseif($order->status == 'proses') text-blue-600
                                   @elseif($order->status == 'dikirim') text-purple-600
                                   @elseif($order->status == 'selesai') text-green-600 
                                   @elseif($order->status == 'cancelled') text-red-600 @endif">
                            {{ ucfirst($order->status) }}
                        </strong>
                    </p>
                    <p>Status Pembayaran:
                        <strong
                            class="@if ($order->payment->pembayaran_status == 'unpaid') text-yellow-600
                               @elseif($order->payment->pembayaran_status == 'paid') text-blue-600
                               @elseif($order->payment->pembayaran_status == 'completed') text-green-600 
                               @elseif($order->payment->pembayaran_status == 'cancelled') text-red-600 @endif">
                            {{ ucfirst($order->payment->pembayaran_status) }}
                        </strong>
                    </p>
                    <p>Metode Pembayaran: <strong>{{ strtoupper($order->payment->metode_pembayaran) }}</strong></p>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 flex flex-col sm:flex-row-reverse sm:justify-start sm:gap-4">
                    <!-- Tombol Kembali -->
                    <a href="{{ route('customer.dashboard') }}"
                        class="w-full sm:w-auto text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-xl transition-colors mb-3 sm:mb-0">
                        Kembali
                    </a>
                    
                    <!-- Tombol Batalkan Pesanan -->
                    @if (in_array($order->status, ['pending', 'proses']))
                        <form action="{{ route('customer.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl transition-colors">
                                Batalkan Pesanan
                            </button>
                        </form>
                    @endif

                    <!-- Tombol Pembayaran -->
                    @if (isset($show_payment_button) && $show_payment_button)
                        <form id="payment-form" action="{{ route('customer.orders.pay', $order) }}" method="POST" class="w-full sm:w-auto mb-3 sm:mb-0">
                            @csrf
                            @if ($order->payment->metode_pembayaran === 'midtrans')
                                <button type="button" id="pay-button"
                                    class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-xl transition-colors">
                                    Bayar Sekarang
                                </button>
                            @elseif($order->payment->metode_pembayaran === 'cod')
                                <button type="submit"
                                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl transition-colors">
                                    Selesaikan (COD)
                                </button>
                            @endif
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@if (isset($show_payment_button) && $show_payment_button && $order->payment->metode_pembayaran === 'midtrans' && isset($snap_token))
    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script>
            document.getElementById('pay-button').addEventListener('click', function() {
                snap.pay('{{ $snap_token }}', {
                    onSuccess: function(result) {
                        window.location.href = "{{ route('customer.orders.success', $order) }}";
                    },
                    onPending: function(result) {
                        alert('Pembayaran pending. Silakan selesaikan dari halaman "Pesanan Saya".');
                        window.location.href = "{{ route('customer.dashboard') }}";
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal. Silakan coba lagi.');
                    },
                    onClose: function() {
                        alert(
                            'Anda menutup popup pembayaran. Pesanan Anda tetap pending dan dapat dibayar nanti dari halaman "Pesanan Saya".'
                        );
                    }
                });
            });
        </script>
    @endpush
@endif
