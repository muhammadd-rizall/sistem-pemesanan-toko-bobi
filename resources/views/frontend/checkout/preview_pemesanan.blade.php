@extends('frontend.layouts.app')

@section('content')
    <div class="min-h-screen bg-sage-50/50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 animate-fade-in-down">
                <div>
                    <h1 class="text-3xl font-bold text-sage-900 font-serif">Rincian Pesanan</h1>
                    <p class="text-sage-500 text-sm mt-1">Invoice ID: <span class="font-mono font-medium text-sage-700">{{ $order->invoice_number ?? 'ORD-' . $order->id }}</span></p>
                </div>
                <div class="flex gap-2">
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold border shadow-sm
                        @if ($order->status == 'pending') bg-yellow-50 text-yellow-700 border-yellow-200
                        @elseif($order->status == 'proses') bg-blue-50 text-blue-700 border-blue-200
                        @elseif($order->status == 'dikirim') bg-purple-50 text-purple-700 border-purple-200
                        @elseif($order->status == 'selesai') bg-green-50 text-green-700 border-green-200
                        @elseif($order->status == 'cancelled') bg-red-50 text-red-700 border-red-200 @endif">
                        <span class="w-2 h-2 rounded-full
                            @if ($order->status == 'pending') bg-yellow-500
                            @elseif($order->status == 'proses') bg-blue-500
                            @elseif($order->status == 'dikirim') bg-purple-500
                            @elseif($order->status == 'selesai') bg-green-500
                            @elseif($order->status == 'cancelled') bg-red-500 @endif animate-pulse"></span>
                        Order: {{ ucfirst($order->status) }}
                    </span>

                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold border shadow-sm
                        @if ($order->payment->pembayaran_status == 'unpaid') bg-gray-50 text-gray-700 border-gray-200
                        @elseif($order->payment->pembayaran_status == 'paid' || $order->payment->pembayaran_status == 'completed') bg-green-50 text-green-700 border-green-200
                        @elseif($order->payment->pembayaran_status == 'cancelled') bg-red-50 text-red-700 border-red-200 @endif">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Pay: {{ ucfirst($order->payment->pembayaran_status) }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in-up">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-2xl shadow-lg shadow-sage-100/50 border border-sage-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-sage-50 bg-sage-50/30">
                            <h2 class="font-bold text-sage-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-sage-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Item Pesanan
                            </h2>
                        </div>
                        <div class="p-6 divide-y divide-sage-50">
                            @foreach ($order->orderItems as $item)
                                <div class="flex gap-4 py-4 first:pt-0 last:pb-0 group">
                                    <div class="w-20 h-20 flex-shrink-0 rounded-xl bg-sage-50 overflow-hidden border border-sage-100 group-hover:border-sage-300 transition-colors">
                                        <img src="{{ asset('storage/' . ($item->product?->gambar_produk ?? 'default.png')) }}"
                                            alt="{{ $item->product?->nama_produk }}"
                                            class="w-full h-full object-cover object-center transform group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-base font-bold text-sage-900 truncate group-hover:text-sage-700 transition-colors">{{ $item->product?->nama_produk ?? 'Produk dihapus' }}</h3>
                                        <p class="text-xs text-sage-500 mt-1">{{ $item->product?->category->name ?? 'Kategori' }}</p>
                                        <div class="flex justify-between items-end mt-2">
                                            <div class="text-sm text-sage-600">
                                                {{ $item->quantity }} x <span class="font-medium">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="font-bold text-sage-800">
                                                Rp {{ number_format($item->harga_total, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg shadow-sage-100/50 border border-sage-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-sage-50 bg-sage-50/30">
                            <h2 class="font-bold text-sage-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-sage-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Informasi Pengiriman
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-10 h-10 rounded-full bg-sage-50 flex items-center justify-center text-sage-600 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-sage-900">{{ $order->customer->name }}</p>
                                    <p class="text-sm text-sage-600 font-mono mt-0.5">{{ $order->no_hp }}</p>
                                </div>
                            </div>

                            <div class="pl-14 space-y-4 relative">
                                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-sage-100 -ml-px"></div>

                                <div class="relative">
                                    <p class="text-xs font-bold text-sage-400 uppercase tracking-wider mb-1">Alamat Tujuan</p>
                                    <p class="text-sage-800 text-sm leading-relaxed">{{ $order->alamat_pengiriman }}</p>
                                </div>

                                @if($order->catatan)
                                <div class="relative pt-2">
                                    <p class="text-xs font-bold text-sage-400 uppercase tracking-wider mb-1">Catatan</p>
                                    <div class="p-3 bg-yellow-50 rounded-lg border border-yellow-100 text-yellow-800 text-sm italic">
                                        "{{ $order->catatan }}"
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-1 space-y-6">

                    <div class="bg-white rounded-2xl shadow-lg shadow-sage-100/50 border border-sage-100 overflow-hidden sticky top-24">
                        <div class="p-6">
                            <h2 class="font-bold text-lg text-sage-900 mb-6">Rincian Pembayaran</h2>

                            <div class="space-y-3 mb-6 pb-6 border-b border-dashed border-sage-200">
                                <div class="flex justify-between text-sm text-sage-600">
                                    <span>Total Harga Awal</span>
                                    <span class="font-medium">Rp {{ number_format($order->total_harga_awal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-green-600">
                                    <span>Diskon</span>
                                    <span class="font-medium">- Rp {{ number_format($order->total_diskon, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-sage-600">
                                    <span>Metode Bayar</span>
                                    <span class="font-bold px-2 py-0.5 bg-sage-50 rounded text-xs">{{ strtoupper($order->payment->metode_pembayaran) }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-end mb-8">
                                <span class="text-sage-900 font-bold">Total Tagihan</span>
                                <span class="text-2xl font-bold text-sage-800">Rp {{ number_format($order->total_harga_akhir, 0, ',', '.') }}</span>
                            </div>

                            <div class="space-y-3">
                                @if (isset($show_payment_button) && $show_payment_button)
                                    <form id="payment-form" action="{{ route('customer.orders.pay', $order) }}" method="POST">
                                        @csrf
                                        @if ($order->payment->metode_pembayaran === 'midtrans')
                                            <button type="button" id="pay-button"
                                                class="w-full py-3.5 bg-sage-600 hover:bg-sage-700 text-white font-bold rounded-xl shadow-lg hover:shadow-sage-200/50 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                Bayar Sekarang
                                            </button>
                                        @elseif($order->payment->metode_pembayaran === 'cod')
                                            <button type="submit"
                                                class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                                                Selesaikan (COD)
                                            </button>
                                        @endif
                                    </form>
                                @endif

                                @if (in_array($order->status, ['pending', 'proses']))
                                    <form action="{{ route('customer.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                        @csrf
                                        <button type="submit" class="w-full py-3 bg-white border-2 border-red-100 text-red-600 font-bold rounded-xl hover:bg-red-50 hover:border-red-200 transition-colors">
                                            Batalkan Pesanan
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('customer.dashboard') }}"
                                    class="block w-full py-3 text-center text-sage-600 font-medium hover:text-sage-800 hover:bg-sage-50 rounded-xl transition-colors">
                                    Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3">
                        <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            Pastikan detail pesanan sudah benar sebelum melakukan pembayaran. Pesanan akan diproses setelah pembayaran dikonfirmasi.
                        </p>
                    </div>

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
