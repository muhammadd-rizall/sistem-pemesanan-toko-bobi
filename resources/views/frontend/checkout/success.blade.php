@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
    <div class="bg-white p-8 rounded-xl shadow-lg text-center max-w-lg w-full">
        <h1 class="text-3xl font-bold mb-4 text-green-600 animate-bounce">🎉 Pembayaran Berhasil!</h1>
        <p class="mb-4">Terima kasih, pesanan Anda telah berhasil diproses.</p>

        <p class="mt-2 font-semibold">
            Invoice: {{ $order->invoice_number ?? '-' }}
        </p>

        <a href="{{ route('home') }}"
           class="mt-6 inline-block bg-green-500 text-white py-3 px-8 rounded-lg font-semibold
                  transform transition duration-300 hover:bg-green-600 hover:scale-105 hover:shadow-lg">
            Kembali Berbelanja 😄
        </a>

        @if ($order->orderItems->isEmpty())
            <p class="mt-4 text-red-500">⚠️ Tidak ada produk terkait dengan pesanan ini.</p>
        @endif
    </div>
</div>
@endsection
