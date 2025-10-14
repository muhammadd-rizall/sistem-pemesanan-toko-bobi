@extends('frontend.layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-sage-50 px-4 py-12">
    <div class="w-full max-w-md space-y-8">
        <!-- Card -->
        <div class="bg-white shadow-2xl rounded-2xl p-8 sm:p-10">
            <div class="text-center">
                <!-- Logo atau Judul -->
                <div class="flex justify-center mb-4">
                    {{-- <a href="{{ route('products.index') }}" class="group flex items-center gap-3"> --}}
                    <a href="{{ route('home') }}" class="group flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-sage-400 to-sage-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                    </a>
                </div>
                <h2 class="text-3xl font-bold text-sage-900">Login ke Akun Anda</h2>
                <p class="mt-2 text-sage-600">Selamat datang kembali!</p>
            </div>

            <form class="mt-8 space-y-6" action="#" method="POST">
    @csrf
    <div class="space-y-4">
        <!-- Input untuk Alamat Email -->
        <div>
            <label for="email-address" class="block text-sm font-medium text-sage-700 mb-1">Alamat Email</label>
            <input id="email-address" name="email" type="email" autocomplete="email" required
                   placeholder="Masukkan alamat email Anda"
                   class="appearance-none relative block w-full px-4 py-3 border border-sage-200 placeholder-sage-400 text-sage-900 rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500 sm:text-sm transition">
        </div>

        <!-- Input untuk Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-sage-700 mb-1">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required
                   placeholder="Masukkan password Anda"
                   class="appearance-none relative block w-full px-4 py-3 border border-sage-200 placeholder-sage-400 text-sage-900 rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500 sm:text-sm transition">
        </div>
    </div>

    <div class="flex items-center justify-between pt-2">
        <div class="flex items-center">
            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-sage-600 focus:ring-sage-500 border-sage-300 rounded">
            <label for="remember-me" class="ml-2 block text-sm text-sage-900">Ingat saya</label>
        </div>

        <div class="text-sm">
            <a href="#" class="font-medium text-sage-600 hover:text-sage-500">Lupa password?</a>
        </div>
    </div>

    <div class="pt-2">
        <button type="submit"
                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-base font-medium rounded-lg text-white bg-sage-600 hover:bg-sage-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sage-500 transition transform hover:scale-105">
            Masuk
        </button>
    </div>
</form>


        </div>

        <!-- Link ke Halaman Register -->
        <p class="mt-6 text-center text-sm text-sage-600">
            Belum punya akun?
            <a href="{{ url('/register') }}" class="font-medium text-sage-600 hover:text-sage-500">
                Daftar di sini
            </a>
        </p>
    </div>
</div>
@endsection
