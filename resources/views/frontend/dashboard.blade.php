@extends('frontend.layouts.app')

@section('content')
<!-- Latar belakang gradien yang lembut -->
<div class="bg-gradient-to-br from-sage-50 via-white to-cream-50 pt-16 pb-16 sm:pt-20 sm:pb-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Selamat Datang -->
        <div class="mb-12 animate-fade-in-down">
            <h1 class="text-4xl font-bold text-sage-900 font-playfair">Akun Saya</h1>
            <p class="mt-2 text-lg text-sage-600">
                Selamat datang kembali, <span class="font-semibold">{{ Auth::guard('customer')->user()->nama_lengkap }}!</span>
            </p>
        </div>

        <!-- Konten Dashboard (Tabel Pesanan) -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg border border-sage-100 animate-fade-in-up">
            <h3 class="text-2xl font-bold text-sage-800 mb-6">Pesanan Terbaru</h3>

            <!-- Tabel Pesanan (Contoh Data) -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b-2 border-sage-200">
                        <tr>
                            <th class="py-3 px-4 text-sm font-semibold text-sage-600 uppercase">ID Pesanan</th>
                            <th class="py-3 px-4 text-sm font-semibold text-sage-600 uppercase">Tanggal</th>
                            <th class="py-3 px-4 text-sm font-semibold text-sage-600 uppercase">Status</th>
                            <th class="py-3 px-4 text-sm font-semibold text-sage-600 uppercase text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <!-- Item Pesanan (Dummy) -->
                        <tr class="border-b border-sage-100 hover:bg-sage-50 transition-colors">
                            <td class="py-4 px-4 font-medium text-sage-800">#12345</td>
                            <td class="py-4 px-4">15 Okt 2025</td>
                            <td class="py-4 px-4">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Selesai</span>
                            </td>
                            <td class="py-4 px-4 font-semibold text-sage-900 text-right">Rp 450.000</td>
                        </tr>
                        <!-- Item Pesanan (Dummy) -->
                        <tr class="border-b border-sage-100 hover:bg-sage-50 transition-colors">
                            <td class="py-4 px-4 font-medium text-sage-800">#12344</td>
                            <td class="py-4 px-4">12 Okt 2025</td>
                            <td class="py-4 px-4">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">Dikirim</span>
                            </td>
                            <td class="py-4 px-4 font-semibold text-sage-900 text-right">Rp 250.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-right">
                <a href="#" class="text-sage-600 font-medium hover:text-sage-800 transition-colors">
                    Lihat semua pesanan &rarr;
                </a>
            </div>
        </div>

    </div>
</div>

<!-- Animasi -->
<style>
    @keyframes fade-in-down { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fade-in-up { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-down { animation: fade-in-down 0.6s ease-out both; }
    .animate-fade-in-up { animation: fade-in-up 0.6s ease-out both; }
</style>
@endsection
