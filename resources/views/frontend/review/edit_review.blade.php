@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-sage-50 via-white to-gray-50 py-12 px-4">
    <div class="max-w-4xl mx-auto">

        <form action="{{ route('customer.review.update', $review->id) }}" method="POST">
            @csrf

            <input type="hidden" name="produk_id" value="{{ $product->id }}">
            <input type="hidden" name="order_id" value="{{ $order->id }}">

            <!-- Header -->
            <div class="text-center mb-10">
                <div class="inline-block mb-4">
                    <div class="bg-sage-100 rounded-full p-4 mb-3">
                        <svg class="w-10 h-10 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Edit Review</h1>
                <p class="text-gray-600 text-lg">Perbarui penilaian Anda untuk produk ini</p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

                <!-- Product Info -->
                <div class="bg-gradient-to-r from-sage-50 to-gray-50 p-8 border-b border-gray-100">
                    <div class="flex items-center gap-6">
                        <img src="{{ asset('storage/' . $product->gambar_produk) }}"
                            class="w-28 h-28 object-cover rounded-2xl shadow-md">

                        <div>
                            <span class="inline-block px-3 py-1 bg-sage-100 text-sage-700 text-xs font-semibold rounded-full mb-2">
                                Produk yang Dibeli
                            </span>
                            <h3 class="font-bold text-2xl text-gray-800">
                                {{ $product->nama_produk }}
                            </h3>
                            <p class="text-3xl font-bold text-sage-600 mt-2">
                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="p-8 space-y-8">

                    <!-- Rating -->
                    <div>
                        <label class="block font-bold text-gray-800 mb-4">
                            Rating Produk
                        </label>

                        <input type="hidden" name="rating" id="rating-value"
                            value="{{ $review->rating }}" required>

                        <div class="flex gap-3 bg-gray-50 p-6 rounded-2xl w-fit" id="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-12 h-12 star cursor-pointer"
                                    data-rating="{{ $i }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967 4.173.012c.969.003 1.371 1.24.588 1.81l-3.385 2.46 1.27 3.972c.285.89-.755 1.628-1.54 1.093L10 13.348l-3.343 2.393c-.784.535-1.824-.203-1.539-1.093l1.269-3.972-3.385-2.46c-.783-.57-.38-1.807.588-1.81l4.173-.012 1.286-3.967z"/>
                                </svg>
                            @endfor
                        </div>
                    </div>

                    <!-- Comment -->
                    <div>
                        <label class="block font-bold text-gray-800 mb-4">
                            Komentar
                        </label>
                        <textarea name="comment" rows="6"
                            class="w-full rounded-2xl border-2 border-gray-200 p-4"
                            required>{{ $review->comment }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-4 pt-6 border-t">

                        <a href="{{ route('customer.dashboard') }}"
                            class="flex-1 px-6 py-4 bg-gray-200 text-gray-700 rounded-xl font-semibold
                            hover:bg-gray-300 hover:scale-105 transition text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 px-6 py-4 bg-gradient-to-r from-sage-600 to-sage-700
                            text-white rounded-xl font-semibold hover:scale-105 transition">
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<style>
.star { color: #D1D5DB }
.star.filled { color: #FBBF24 }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    const input = document.getElementById('rating-value');
    let current = parseInt(input.value);

    function update(rating) {
        stars.forEach((s, i) =>
            i < rating ? s.classList.add('filled') : s.classList.remove('filled')
        );
    }

    update(current);

    stars.forEach(star => {
        star.addEventListener('click', () => {
            current = star.dataset.rating;
            input.value = current;
            update(current);
        });
    });
});
</script>
@endsection
