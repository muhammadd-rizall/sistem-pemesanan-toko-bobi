<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bobi Ceramic's</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .sidebar .nav-text {
            display: none;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
        }
        .sidebar:hover .nav-text {
            display: inline-block;
            opacity: 1;
        }
    </style>
</head>
<body class="bg-sage-50 font-sans antialiased">

    {{-- 1. Hapus class 'group' dari sini --}}
    <div class="flex h-screen bg-gray-100">

        {{-- 2. Tambahkan class 'peer' ke sidebar --}}
        <aside class="sidebar peer bg-sage-800 text-white w-20 hover:w-64 transition-all duration-300 ease-in-out flex flex-col fixed h-full z-40">

    <div class="flex items-center justify-center h-20 border-b border-sage-700/50">
        <div class="w-10 h-10 bg-sage-600 rounded-lg flex items-center justify-center min-w-[40px]">
           <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.24a2 2 0 00-1.806.547a2 2 0 00-.547 1.806l.477 2.387a6 6 0 00.517 3.86l.158.318a6 6 0 00.517 3.86l2.387.477a2 2 0 001.806-.547a2 2 0 00.547-1.806l-.477-2.387a6 6 0 00-.517-3.86l-.158-.318a6 6 0 00-.517-3.86l-2.387-.477a2 2 0 00-.547-1.806zM15 9.75a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
         <span class="nav-text ml-3 text-xl font-bold whitespace-nowrap">Admin</span>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">
        {{-- Link Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 bg-sage-700 rounded-lg transition-colors">
            <svg class="w-6 h-6 min-w-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="nav-text ml-4 whitespace-nowrap">Dashboard</span>
        </a>

        {{-- Link Produk --}}
        <a href="{{ route('produk_view') }}" class="flex items-center px-4 py-2.5 text-sage-100 hover:bg-sage-700 hover:text-white rounded-lg transition-colors">
            <svg class="w-6 h-6 min-w-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <span class="nav-text ml-4 whitespace-nowrap">Produk</span>
        </a>

        {{-- Link Pemesanan --}}
        <a href="#" class="flex items-center px-4 py-2.5 text-sage-100 hover:bg-sage-700 hover:text-white rounded-lg transition-colors">
             <svg class="w-6 h-6 min-w-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            <span class="nav-text ml-4 whitespace-nowrap">Pemesanan</span>
        </a>

        {{-- BARU: Link Promosi/Diskon --}}
        <a href="#" class="flex items-center px-4 py-2.5 text-sage-100 hover:bg-sage-700 hover:text-white rounded-lg transition-colors">
            <svg class="w-6 h-6 min-w-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A2 2 0 013 8V5a2 2 0 012-2z"></path></svg>
            <span class="nav-text ml-4 whitespace-nowrap">Promosi</span>
        </a>

        {{-- BARU: Link Galeri --}}
        <a href="#" class="flex items-center px-4 py-2.5 text-sage-100 hover:bg-sage-700 hover:text-white rounded-lg transition-colors">
            <svg class="w-6 h-6 min-w-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="nav-text ml-4 whitespace-nowrap">Galeri</span>
        </a>

        {{-- BARU: Link User --}}
        <a href="#" class="flex items-center px-4 py-2.5 text-sage-100 hover:bg-sage-700 hover:text-white rounded-lg transition-colors">
            <svg class="w-6 h-6 min-w-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span class="nav-text ml-4 whitespace-nowrap">User</span>
        </a>
    </nav>
</aside>

        {{-- 3. Ganti 'group-hover' menjadi 'peer-hover' di sini --}}
        <div class="flex-1 flex flex-col pl-20 peer-hover:pl-64 lg:peer-hover:pl-64 transition-all duration-300 ease-in-out">
            <header class="bg-white shadow-sm flex items-center justify-between px-6 py-4 z-30">
                <div class="font-semibold text-lg text-sage-800">
                   Bobi Ceramic's Dashboard
                </div>
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 focus:outline-none">
                        <img class="h-10 w-10 rounded-full object-cover border-2 border-sage-200" src="https://ui-avatars.com/api/?name=Admin&background=a8c9a8&color=2f4f39" alt="Admin Profile">
                    </button>
                    <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-cloak
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-20 py-1">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sage-100">Profil</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sage-100">Logout</a>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6 sm:p-8 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
