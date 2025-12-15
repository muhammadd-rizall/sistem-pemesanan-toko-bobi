@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-sage-50 via-white to-gray-50 py-12 px-4">
    <div class="max-w-4xl mx-auto">

        <form action="{{ route('customer.review.store', $order->id) }}" method="POST">
            @csrf

            <input type="hidden" name="produk_id" value="{{ $product->id }}">
            <input type="hidden" name="order_id" value="{{ $order->id }}">


            <!-- Header dengan animasi -->
            <div class="text-center mb-10">
                <div class="inline-block mb-4">
                    <div class="bg-sage-100 rounded-full p-4 mb-3">
                        <svg class="w-10 h-10 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-3 tracking-tight">Beri Penilaian Anda</h1>
                <p class="text-gray-600 text-lg">Bagikan pengalaman Anda dengan produk ini</p>
            </div>

            <!-- Card Utama -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

                <!-- Product Info Section -->
                <div class="bg-gradient-to-r from-sage-50 to-gray-50 p-8 border-b border-gray-100">
                    <div class="flex items-center gap-6">
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $product->gambar_produk) }}"
                                alt="{{ $product->nama_produk }}"
                                class="w-28 h-28 object-cover rounded-2xl shadow-md group-hover:shadow-xl transition-shadow duration-300">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-5 rounded-2xl transition-all duration-300"></div>
                        </div>

                        <div class="flex-1">
                            <span class="inline-block px-3 py-1 bg-sage-100 text-sage-700 text-xs font-semibold rounded-full mb-2">
                                Produk yang Dibeli
                            </span>
                            <h3 class="font-bold text-2xl text-gray-800 mb-2">
                                {{ $product->nama_produk }}
                            </h3>
                            <div class="flex items-baseline gap-2">
                                <p class="text-3xl font-bold text-sage-600">
                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="p-8 space-y-8">

                    <!-- Rating Section -->
                    <div>
                        <label class="block text-base font-bold text-gray-800 mb-4">
                            Berapa bintang untuk produk ini?
                        </label>

                        <input type="hidden" name="rating" id="rating-value" value="5" required>

                        <div class="flex items-center gap-3 bg-gray-50 p-6 rounded-2xl w-fit" id="star-rating">
                            <svg class="w-12 h-12 star cursor-pointer transition-all duration-200 hover:scale-110"
                                 data-rating="1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967 4.173.012c.969.003 1.371 1.24.588 1.81l-3.385 2.46 1.27 3.972c.285.89-.755 1.628-1.54 1.093L10 13.348l-3.343 2.393c-.784.535-1.824-.203-1.539-1.093l1.269-3.972-3.385-2.46c-.783-.57-.38-1.807.588-1.81l4.173-.012 1.286-3.967z"/>
                            </svg>
                            <svg class="w-12 h-12 star cursor-pointer transition-all duration-200 hover:scale-110"
                                 data-rating="2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967 4.173.012c.969.003 1.371 1.24.588 1.81l-3.385 2.46 1.27 3.972c.285.89-.755 1.628-1.54 1.093L10 13.348l-3.343 2.393c-.784.535-1.824-.203-1.539-1.093l1.269-3.972-3.385-2.46c-.783-.57-.38-1.807.588-1.81l4.173-.012 1.286-3.967z"/>
                            </svg>
                            <svg class="w-12 h-12 star cursor-pointer transition-all duration-200 hover:scale-110"
                                 data-rating="3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967 4.173.012c.969.003 1.371 1.24.588 1.81l-3.385 2.46 1.27 3.972c.285.89-.755 1.628-1.54 1.093L10 13.348l-3.343 2.393c-.784.535-1.824-.203-1.539-1.093l1.269-3.972-3.385-2.46c-.783-.57-.38-1.807.588-1.81l4.173-.012 1.286-3.967z"/>
                            </svg>
                            <svg class="w-12 h-12 star cursor-pointer transition-all duration-200 hover:scale-110"
                                 data-rating="4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967 4.173.012c.969.003 1.371 1.24.588 1.81l-3.385 2.46 1.27 3.972c.285.89-.755 1.628-1.54 1.093L10 13.348l-3.343 2.393c-.784.535-1.824-.203-1.539-1.093l1.269-3.972-3.385-2.46c-.783-.57-.38-1.807.588-1.81l4.173-.012 1.286-3.967z"/>
                            </svg>
                            <svg class="w-12 h-12 star cursor-pointer transition-all duration-200 hover:scale-110"
                                 data-rating="5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967 4.173.012c.969.003 1.371 1.24.588 1.81l-3.385 2.46 1.27 3.972c.285.89-.755 1.628-1.54 1.093L10 13.348l-3.343 2.393c-.784.535-1.824-.203-1.539-1.093l1.269-3.972-3.385-2.46c-.783-.57-.38-1.807.588-1.81l4.173-.012 1.286-3.967z"/>
                            </svg>
                        </div>

                        <p class="text-sm text-gray-500 mt-3 ml-1">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            Klik pada bintang untuk memberikan rating
                        </p>
                    </div>

                    <!-- Comment Section -->
                    <div>
                        <label class="block text-base font-bold text-gray-800 mb-4">
                            Ceritakan pengalaman Anda
                        </label>
                        <div class="relative">
                            <textarea name="comment" rows="6"
                                class="w-full rounded-2xl border-2 border-gray-200
                                    focus:ring-4 focus:ring-sage-100 focus:border-sage-500
                                    transition-all duration-200 resize-none p-4 text-gray-700"
                                placeholder="Bagaimana kualitas produknya? Apakah sesuai dengan ekspektasi? Apa yang Anda sukai dari produk ini?"
                                required></textarea>
                            <div class="absolute bottom-4 right-4 text-xs text-gray-400">
                                Min. 10 karakter
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-3 ml-1 flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Review Anda akan membantu pembeli lain membuat keputusan yang lebih baik</span>
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('customer.dashboard') }}"
                            class="flex-1 px-6 py-4 bg-gray-100 hover:bg-gray-200
                                text-gray-700 rounded-xl font-semibold text-center
                                transition-all duration-200 hover:shadow-md">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 px-6 py-4 bg-gradient-to-r from-sage-600 to-sage-700
                                hover:from-sage-700 hover:to-sage-800 text-white rounded-xl
                                font-semibold transition-all duration-200 shadow-lg
                                hover:shadow-xl hover:scale-105 active:scale-95
                                flex items-center justify-center gap-2 group">
                            <span>Kirim Review</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>


        </form>

    </div>
</div>

<style>
    /* Custom animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .bg-white {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Star styles */
    .star {
        color: #D1D5DB; /* gray-300 */
    }

    .star.filled {
        color: #FBBF24; /* yellow-400 */
        transform: scale(1.1);
    }

    .star:hover {
        color: #FCD34D; /* yellow-300 */
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating-value');
    const starContainer = document.getElementById('star-rating');
    let currentRating = 5; // Default 5 bintang

    // Function untuk update tampilan bintang
    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('filled');
            } else {
                star.classList.remove('filled');
            }
        });
    }

    // Set default 5 bintang saat load
    updateStars(5);

    // Event click untuk setiap bintang
    stars.forEach((star) => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.getAttribute('data-rating'));
            currentRating = rating;
            ratingInput.value = rating;
            updateStars(rating);
        });

        // Hover effect
        star.addEventListener('mouseenter', function() {
            const rating = parseInt(this.getAttribute('data-rating'));
            updateStars(rating);
        });
    });

    // Reset ke rating yang dipilih saat mouse leave
    starContainer.addEventListener('mouseleave', function() {
        updateStars(currentRating);
    });
});
</script>
@endsection
