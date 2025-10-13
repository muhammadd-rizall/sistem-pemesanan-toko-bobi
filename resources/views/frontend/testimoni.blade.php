@extends('frontend.layouts.app')

@section('content')
<div class="bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <!-- Judul Section -->
        <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16 animate-fade-in-down">
            <h1 class="text-4xl sm:text-5xl font-bold text-sage-900">Apa Kata Pelanggan Kami?</h1>
            <p class="mt-4 text-lg text-sage-600">Kepuasan Anda adalah bukti kualitas dan prioritas utama kami.</p>
        </div>

        <!-- Grid Testimoni -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimoni 1 -->
            <div class="bg-sage-50 rounded-2xl p-8 flex flex-col justify-between shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.1s;">
                <p class="text-sage-800 mb-6 italic leading-relaxed">"Pelayanannya ramah banget, dibantu pilih motif sampai cocok. Hasil pasangnya rapi dan rumah saya jadi kelihatan mewah. Recommended!"</p>
                <div class="mt-auto flex items-center gap-4 border-t border-sage-200 pt-4">
                    <img class="w-14 h-14 rounded-full object-cover" src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Andi Budiman">
                    <div>
                        <p class="font-bold text-sage-900">Andi Budiman</p>
                        <p class="text-sm text-sage-600">Pemilik Rumah, Padang</p>
                    </div>
                </div>
            </div>
            <!-- Testimoni 2 -->
            <div class="bg-sage-50 rounded-2xl p-8 flex flex-col justify-between shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.2s;">
                <p class="text-sage-800 mb-6 italic leading-relaxed">"Kualitas keramiknya tidak perlu diragukan. Untuk proyek kafe saya, Bobi Ceramic's memberikan solusi terbaik dengan harga yang kompetitif."</p>
                <div class="mt-auto flex items-center gap-4 border-t border-sage-200 pt-4">
                    <img class="w-14 h-14 rounded-full object-cover" src="https://i.pravatar.cc/150?u=a042581f4e29026705d" alt="Siti Lestari">
                    <div>
                        <p class="font-bold text-sage-900">Siti Lestari</p>
                        <p class="text-sm text-sage-600">Owner Cafe, Bukittinggi</p>
                    </div>
                </div>
            </div>
            <!-- Testimoni 3 -->
            <div class="bg-sage-50 rounded-2xl p-8 flex flex-col justify-between shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.3s;">
                <p class="text-sage-800 mb-6 italic leading-relaxed">"Pilihan motifnya banyak dan modern. Proses pemesanan sampai pengiriman cepat dan aman. Pasti akan order di sini lagi untuk proyek selanjutnya."</p>
                <div class="mt-auto flex items-center gap-4 border-t border-sage-200 pt-4">
                    <img class="w-14 h-14 rounded-full object-cover" src="https://i.pravatar.cc/150?u=a042581f4e29026706d" alt="Rahmat Hidayat">
                    <div>
                        <p class="font-bold text-sage-900">Rahmat Hidayat</p>
                        <p class="text-sm text-sage-600">Kontraktor</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
