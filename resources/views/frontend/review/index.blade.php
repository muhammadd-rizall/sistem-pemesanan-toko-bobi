@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-sage-50 via-white to-gray-50 py-16 px-4">
    <div class="max-w-6xl mx-auto">

        <!-- Header -->
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Review Saya</h1>
                <p class="text-gray-500 mt-1">Daftar semua review yang telah Anda kirim</p>
            </div>

            <a href="{{ route('customer.dashboard') }}"
                class="px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-xl font-semibold">
                ← Kembali
            </a>
        </div>

        <!-- List Review -->
        <div class="space-y-6">
            @forelse ($reviews as $review)
                <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">

                    <div class="flex items-start gap-6">
                        <!-- Produk -->
                        <img src="{{ asset('storage/' . $review->produk->gambar_produk) }}"
                            class="w-24 h-24 object-cover rounded-2xl">

                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800">
                                {{ $review->produk->nama_produk }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Invoice: #{{ $review->order->invoice_number }}
                            </p>

                            <!-- Rating -->
                            <div class="flex items-center mt-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.3-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>

                            <p class="text-gray-600 mt-3">
                                {{ $review->comment }}
                            </p>

                            <p class="text-xs text-gray-400 mt-3">
                                Ditulis {{ $review->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <!-- Action -->
                        <div class="flex flex-col gap-2">
                            
                            <a href="{{ route('customer.review.edit', $review->id) }}"
                                class="px-4 py-2 bg-gray-100 rounded-xl text-sm text-center">
                                Edit
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                <p class="text-center text-gray-500">
                    Belum ada review.
                </p>
            @endforelse
        </div>

    </div>
</div>
@endsection
