@extends('frontend.layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Rincian Pesanan</h1>

            <div class="space-y-4">
                <!-- List Items -->
                <div class="flex items-center gap-4">
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
                    <p>Nomor Hp: {{ $order->formatted_no_hp }}</p>
                    <p>Alamat: {{ $order->alamat_pengiriman }}</p>
                    <p>Catatan: {{ $order->catatan ?? '-' }}</p>
                </div>

                <!-- Ringkasan Harga -->
                <div class="border-t pt-4">
                    <h3 class="font-semibold text-gray-700">Ringkasan Harga</h3>
                    <p>Total Harga Awal: Rp {{ number_format($order->total_harga_awal, 0, ',', '.') }}</p>
                    <p>Total Diskon: Rp {{ number_format($order->total_diskon, 0, ',', '.') }}</p>
                    <p class="text-2xl font-bold text-green-600">Total Akhir: Rp
                        {{ number_format($order->total_harga_akhir, 0, ',', '.') }}</p>
                    <p>Metode Pembayaran: <strong>{{ strtoupper($order->payment->metode_pembayaran) }}</strong></p>
                </div>

                <!-- Tombol Pembayaran -->
                <form id="payment-form" action="{{ route('customer.orders.pay', $order) }}" method="POST">
                    @csrf

                    {{-- JIKA MIDTRANS --}}
                    @if ($order->payment->metode_pembayaran === 'midtrans')
                        <button type="button" id="pay-button"
                            class="w-full bg-[#7eb17e] hover:bg-[#6da16d] text-white font-bold py-3 rounded-xl mt-6">
                            Bayar Sekarang
                        </button>

                    {{-- JIKA COD --}}
                    @elseif ($order->payment->metode_pembayaran === 'cod')
                        <button type="submit"
                            class="w-full bg-[#7eb17e] hover:bg-[#6da16d] text-white font-bold py-3 rounded-xl mt-6">
                            Selesaikan Pesanan (COD)
                        </button>
                    @endif

                </form>
            </div>
        </div>
    </div>

    @if ($order->payment->metode_pembayaran === 'midtrans')
        @push('scripts')
            <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>

            <script>
                document.getElementById('pay-button').addEventListener('click', function() {
                    snap.pay('{{ $snap_token }}', {
                        onSuccess: function(result) {
                            window.location.href = "{{ route('customer.orders.success', $order) }}";
                        },
                        onPending: function(result) {
                            alert('Pembayaran pending. Silakan selesaikan nanti.');
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal. Silakan coba lagi.');
                        }
                    });
                });
            </script>
        @endpush
    @endif
@endsection
