<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Bobi Ceramic's</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --sage-600: #4a7c59;
            --sage-700: #3d6649;
            --sage-900: #1f3327;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-sage-50 flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 transition-all">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-sage-400 to-sage-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>

        <h2 class="text-3xl font-bold text-center text-sage-900">Admin Login</h2>
        <p class="text-center text-sage-600 mt-2 mb-8">Selamat datang, silahkan masuk.</p>

        <!-- Menampilkan Error Validasi -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-sage-700 mb-1">Alamat Email</label>
                <input id="email" name="email" type="email" autocomplete="email" required
                       placeholder="admin@example.com"
                       class="w-full px-4 py-3 border border-sage-200 placeholder-sage-400 text-sage-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-sage-500 focus:border-sage-500 transition">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-sage-700 mb-1">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                       placeholder="••••••••"
                       class="w-full px-4 py-3 border border-sage-200 placeholder-sage-400 text-sage-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-sage-500 focus:border-sage-500 transition">
            </div>

            <!-- Ingat Saya & Lupa Password -->
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-sage-600 focus:ring-sage-500 border-sage-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sage-900">Ingat saya</ia_label>
                </div>
                {{-- <a href="#" class="font-medium text-sage-600 hover:text-sage-500">Lupa password?</a> --}}
            </div>

            <!-- Tombol Submit -->
            <div>
                <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-base font-medium rounded-lg text-white bg-sage-600 hover:bg-sage-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sage-500 transition transform hover:scale-105">
                    Masuk
                </button>
            </div>
        </form>
    </div>

</body>
</html>
