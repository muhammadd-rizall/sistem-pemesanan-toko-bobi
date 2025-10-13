@extends('frontend.layouts.app')

@section('content')
<div class="bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <!-- Judul Section -->
        <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16 animate-fade-in-down">
            <h1 class="text-4xl sm:text-5xl font-bold text-sage-900">Hubungi Kami</h1>
            <p class="mt-4 text-lg text-sage-600">Ada pertanyaan? Jangan ragu untuk menghubungi atau mengunjungi kami.</p>
        </div>

        <!-- Konten Kontak -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 bg-sage-50 p-8 sm:p-12 rounded-2xl shadow-lg">
            <!-- Kolom Informasi -->
            <div class="animate-fade-in-up">
                <h3 class="text-2xl font-semibold mb-6 text-sage-800">Informasi & Lokasi</h3>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="bg-sage-600 p-3 rounded-full text-white mt-1"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                        <div>
                            <h4 class="font-semibold text-lg text-sage-900">Alamat Toko</h4>
                            <p class="text-sage-700">Jl. Khatib Sulaiman No. 123, Padang, Sumatera Barat</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="bg-sage-600 p-3 rounded-full text-white mt-1"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></div>
                        <div>
                            <h4 class="font-semibold text-lg text-sage-900">Email</h4>
                            <p class="text-sage-700">info@bobiceramics.com</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="bg-sage-600 p-3 rounded-full text-white mt-1"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg></div>
                        <div>
                            <h4 class="font-semibold text-lg text-sage-900">Telepon / WhatsApp</h4>
                            <p class="text-sage-700">0812-3456-7890</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kolom Form -->
            <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                 <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-sage-700 mb-1">Nama Anda</label>
                        <input type="text" id="name" placeholder="Masukkan nama Anda" class="w-full px-4 py-3 bg-white rounded-lg border-2 border-sage-200 focus:outline-none focus:ring-2 focus:ring-sage-500 transition-all duration-300">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-sage-700 mb-1">Email Anda</label>
                        <input type="email" id="email" placeholder="Masukkan email Anda" class="w-full px-4 py-3 bg-white rounded-lg border-2 border-sage-200 focus:outline-none focus:ring-2 focus:ring-sage-500 transition-all duration-300">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-sage-700 mb-1">Pesan Anda</label>
                        <textarea id="message" placeholder="Tulis pesan Anda di sini..." rows="5" class="w-full px-4 py-3 bg-white rounded-lg border-2 border-sage-200 focus:outline-none focus:ring-2 focus:ring-sage-500 transition-all duration-300"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-sage-600 hover:bg-sage-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
