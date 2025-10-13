@extends('frontend.layouts.app')

@section('content')
<div class="bg-cream-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <!-- Bagian Atas: Visi & Misi -->
        <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-in-down">
            <h1 class="text-4xl sm:text-5xl font-bold text-sage-900">Cerita di Balik Setiap Karya</h1>
            <p class="mt-4 text-lg text-sage-700 leading-relaxed">
                Bobi Ceramic's lahir dari kecintaan terhadap seni dan keindahan dalam detail. Berdiri sejak tahun 2010, kami berkomitmen untuk menyediakan keramik berkualitas yang memperindah setiap ruangan.
            </p>
        </div>

        <!-- Bagian Tengah: Gambar dan Poin Keunggulan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
            <!-- Kolom Gambar -->
            <div class="animate-fade-in-up">
                <img src="{{ asset('storage/images/background-hero.jpg') }}" alt="Tim Bobi Ceramic's" class="rounded-2xl shadow-xl w-full h-full object-cover aspect-video lg:aspect-square">
            </div>
            <!-- Kolom Teks -->
            <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                <h2 class="text-3xl font-semibold text-sage-800 mb-6">Komitmen Kami Pada Kualitas</h2>
                <ul class="space-y-5 text-sage-800">
                    <li class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-sage-200 rounded-full text-sage-700">✓</div>
                        <span><strong class="font-semibold block">Kualitas Terbaik:</strong> Menggunakan bahan baku pilihan dari sumber terpercaya untuk memastikan kekuatan dan daya tahan maksimal pada setiap produk.</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-sage-200 rounded-full text-sage-700">✓</div>
                        <span><strong class="font-semibold block">Desain Inovatif:</strong> Tim desainer kami selalu mengikuti tren global terkini tanpa meninggalkan sentuhan klasik yang abadi.</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-sage-200 rounded-full text-sage-700">✓</div>
                        <span><strong class="font-semibold block">Pelayanan Profesional:</strong> Kami percaya bahwa pengalaman belanja harus menyenangkan. Tim kami siap membantu Anda dari konsultasi hingga proses pemasangan.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
