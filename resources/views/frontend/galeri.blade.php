@extends('frontend.layouts.app')

@section('content')
<div class="bg-cream-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <!-- Judul Section -->
        <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16 animate-fade-in-down">
            <h1 class="text-4xl sm:text-5xl font-bold text-sage-900">Galeri Inspirasi</h1>
            <p class="mt-4 text-lg text-sage-600">Lihat bagaimana produk kami mengubah ruangan menjadi lebih hidup dan berkarakter.</p>
        </div>

        <!-- Grid Galeri -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $galleryImages = [
                    asset('storage/products/keramik.jpeg'),
                    asset('storage/products/wastafel.jpg'),
                    asset('storage/products/shower.jpg'),
                    asset('storage/products/pintu.jpg'),
                    asset('storage/products/kloset.jpg'),
                    asset('storage/products/stepnosing.jpg'),
                ];
            @endphp

            @foreach($galleryImages as $index => $image)
                <div class="group relative overflow-hidden rounded-2xl shadow-lg animate-fade-in-up" style="animation-delay: {{ $index * 100 }}ms;">
                    <img src="{{ $image }}" alt="Galeri Proyek {{ $index + 1 }}" class="w-full h-80 object-cover transform group-hover:scale-110 transition-transform duration-500 ease-in-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <h3 class="text-white text-xl font-semibold drop-shadow-md">Proyek Ruang Tamu Modern</h3>
                        <p class="text-gray-200 text-sm mt-1 drop-shadow-sm">Padang, 2025</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
