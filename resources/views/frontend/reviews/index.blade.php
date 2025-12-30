@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-sage-50/30 to-white py-10 relative overflow-hidden">
    <!-- Subtle Background Patterns -->
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at 1px 1px, rgb(22 101 52) 1px, transparent 0); background-size: 40px 40px;"></div>

    <div class="container mx-auto px-4 max-w-6xl relative z-10">
        <!-- Back Button -->
        <div class="mb-6 opacity-0 animate-[fadeInDown_0.5s_ease-out_forwards]">
            <a href="{{ route('products.show', $product->id) }}"
               class="inline-flex items-center gap-2 text-sage-600 hover:text-sage-800 font-medium transition-all duration-300 group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Kembali ke Produk</span>
            </a>
        </div>

        <!-- Header Section -->
        <div class="text-center mb-12 opacity-0 animate-[fadeInUp_0.6s_ease-out_0.1s_forwards]">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-3 tracking-tight">
                Ulasan Pelanggan
            </h1>
            <p class="text-xl text-sage-600 font-medium mb-2">{{ $product->nama_produk }}</p>
            <p class="text-slate-500">Apa kata pelanggan kami</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-12">
            <!-- Total Reviews -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 opacity-0 animate-[fadeInUp_0.6s_ease-out_0.2s_forwards]">
                <div class="text-4xl font-bold text-slate-800 mb-2">{{ $totalReviews }}</div>
                <div class="text-sm text-slate-600 font-medium">Total Ulasan</div>
            </div>

            <!-- Average Rating -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 opacity-0 animate-[fadeInUp_0.6s_ease-out_0.3s_forwards]">
                <div class="text-4xl font-bold text-slate-800 mb-2">{{ number_format($averageRating, 1) }}</div>
                <div class="text-sm text-slate-600 font-medium">Rating Rata-rata</div>
            </div>

            <!-- Verified Buyers -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 opacity-0 animate-[fadeInUp_0.6s_ease-out_0.4s_forwards]">
                <div class="text-4xl font-bold text-slate-800 mb-2">{{ $reviews->where('customer.email_verified_at', '!=', null)->count() }}</div>
                <div class="text-sm text-slate-600 font-medium">Pembeli Terverifikasi</div>
            </div>

            <!-- Recommendation Rate -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300 opacity-0 animate-[fadeInUp_0.6s_ease-out_0.5s_forwards]">
                <div class="text-4xl font-bold text-slate-800 mb-2">{{ $reviews->where('rating', '>=', 4)->count() > 0 ? round(($reviews->where('rating', '>=', 4)->count() / $totalReviews) * 100) : 0 }}%</div>
                <div class="text-sm text-slate-600 font-medium">Merekomendasikan</div>
            </div>
        </div>

        <!-- Filter Buttons -->
        <div class="flex flex-wrap items-center gap-3 mb-10 opacity-0 animate-[fadeIn_0.6s_ease-out_0.6s_forwards]">
            <a href="{{ route('product.reviews', $product->id) }}"
               class="px-6 py-2.5 rounded-full font-medium transition-all duration-300 shadow-sm hover:shadow-md {{ !request('rating') && !request('verified') ? 'bg-sage-600 text-white hover:bg-sage-700' : 'bg-white border border-slate-200 text-slate-700 hover:border-sage-600 hover:text-sage-600' }}">
                Semua Ulasan
            </a>

            <a href="{{ route('product.reviews', ['id' => $product->id, 'rating' => 5]) }}"
               class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 flex items-center gap-2 {{ request('rating') == 5 ? 'bg-sage-600 text-white hover:bg-sage-700 border-transparent' : 'bg-white border border-slate-200 text-slate-700 hover:border-sage-600 hover:text-sage-600' }}">
                <span class="{{ request('rating') == 5 ? 'text-white' : 'text-yellow-400' }}">⭐</span> 5 Bintang
            </a>

            <a href="{{ route('product.reviews', ['id' => $product->id, 'rating' => 4]) }}"
               class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 flex items-center gap-2 {{ request('rating') == 4 ? 'bg-sage-600 text-white hover:bg-sage-700 border-transparent' : 'bg-white border border-slate-200 text-slate-700 hover:border-sage-600 hover:text-sage-600' }}">
                <span class="{{ request('rating') == 4 ? 'text-white' : 'text-yellow-400' }}">⭐</span> 4 Bintang
            </a>

            <a href="{{ route('product.reviews', ['id' => $product->id, 'rating' => 3]) }}"
               class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 flex items-center gap-2 {{ request('rating') == 3 ? 'bg-sage-600 text-white hover:bg-sage-700 border-transparent' : 'bg-white border border-slate-200 text-slate-700 hover:border-sage-600 hover:text-sage-600' }}">
                <span class="{{ request('rating') == 3 ? 'text-white' : 'text-yellow-400' }}">⭐</span> 3 Bintang
            </a>

            <a href="{{ route('product.reviews', ['id' => $product->id, 'rating' => 2]) }}"
               class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 flex items-center gap-2 {{ request('rating') == 2 ? 'bg-sage-600 text-white hover:bg-sage-700 border-transparent' : 'bg-white border border-slate-200 text-slate-700 hover:border-sage-600 hover:text-sage-600' }}">
                <span class="{{ request('rating') == 2 ? 'text-white' : 'text-yellow-400' }}">⭐</span> 2 Bintang
            </a>

            <a href="{{ route('product.reviews', ['id' => $product->id, 'rating' => 1]) }}"
               class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 flex items-center gap-2 {{ request('rating') == 1 ? 'bg-sage-600 text-white hover:bg-sage-700 border-transparent' : 'bg-white border border-slate-200 text-slate-700 hover:border-sage-600 hover:text-sage-600' }}">
                <span class="{{ request('rating') == 1 ? 'text-white' : 'text-yellow-400' }}">⭐</span> 1 Bintang
            </a>

            <a href="{{ route('product.reviews', ['id' => $product->id, 'verified' => 1]) }}"
               class="px-5 py-2.5 rounded-full font-medium transition-all duration-300 flex items-center gap-2 {{ request('verified') ? 'bg-sage-600 text-white hover:bg-sage-700 border-transparent' : 'bg-white border border-slate-200 text-slate-700 hover:border-sage-600 hover:text-sage-600' }}">
                <svg class="w-4 h-4 {{ request('verified') ? 'text-white' : 'text-sage-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Terverifikasi
            </a>
        </div>

        <!-- Reviews Grid -->
        <div class="grid md:grid-cols-2 gap-6 mt-12">
            @forelse($reviews as $review)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 animate-[fadeInUp_0.5s_ease-out_forwards]">

                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-sage-400 to-sage-600 flex items-center justify-center text-white font-bold text-lg shadow-md flex-shrink-0">
                                @if($review->customer && $review->customer->avatar)
                                    <img src="{{ Str::startsWith($review->customer->avatar, 'http') ? $review->customer->avatar : asset('storage/' . $review->customer->avatar) }}"
                                         alt="{{ $review->customer->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($review->customer->name ?? 'U', 0, 1)) }}
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="font-bold text-slate-800">{{ $review->customer->name ?? 'Customer' }}</h3>
                                    @if($review->customer && $review->customer->email_verified_at)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-sage-100 text-sage-700 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Verified
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $review->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                            <span class="text-lg font-bold text-slate-800">{{ $review->rating }}</span>
                            <span class="text-yellow-400 text-sm">★</span>
                        </div>
                    </div>

                    <div class="flex gap-1 mb-4">
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400 fill-current' : 'text-slate-200 fill-current' }}" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>

                    <p class="text-slate-700 leading-relaxed relative z-10">
                        {{ $review->comment ?? $review->komentar ?? $review->review ?? '-' }}
                    </p>

                    <div class="absolute top-6 right-6 text-slate-100 text-8xl leading-none font-serif opacity-50 pointer-events-none select-none">"</div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 py-16 text-center bg-white rounded-2xl border border-dashed border-slate-300 animate-[fadeInUp_0.5s_ease-out_forwards]">
                    <div class="inline-block p-4 rounded-full bg-slate-50 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900">Belum ada ulasan</h3>
                    <p class="text-slate-500 mt-1">Jadilah yang pertama memberikan ulasan untuk produk ini!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center opacity-0 animate-[fadeIn_0.6s_ease-out_1s_forwards]">
            {{ $reviews->links() }}
        </div>
    </div>
</div>

<style>
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

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

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
@endsection
