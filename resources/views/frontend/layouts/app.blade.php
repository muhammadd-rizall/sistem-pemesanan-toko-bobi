<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bobi Ceramic's - Dekorasi Rumah yang Elegan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --sage-50: #f6f8f6;
            --sage-100: #e8f0e8;
            --sage-200: #d1e1d1;
            --sage-300: #a8c9a8;
            --sage-400: #7eb17e;
            --sage-600: #4a7c59;
            --sage-700: #3d6649;
            --sage-800: #2f4f39;
            --sage-900: #1f3327;
            --cream-50: #faf8f5;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }

        html {
            scroll-behavior: smooth;
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu.active {
            max-height: 600px;
        }

        .navbar-scrolled {
            /* background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(74, 124, 89, 0.08); */
            background: #a9bea9;
            /* Ini warna sage-100 transparan */
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(74, 124, 89, 0.08);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--sage-50);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--sage-400);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--sage-600);
        }

        /* ... CSS Anda yang lain ... */

        /* Modal Animation Styles (TAMBAHKAN INI) */
        .modal {
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-content {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        }
    </style>
</head>

<body class="bg-white text-gray-900 antialiased">

    <!-- Header -->
    <header class="bg-sage-200 sticky top-0 z-50 transition-all duration-300 border-b border-sage-100" id="navbar">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4 sm:py-5">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="group flex items-center gap-3">
                    <div class="relative">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-sage-400 to-sage-600 rounded-xl flex items-center justify-center transform group-hover:rotate-6 transition-all duration-300 shadow-lg">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-sage-400 rounded-full animate-ping opacity-75">
                        </div>
                    </div>
                    <span
                        class="text-2xl sm:text-3xl font-bold text-sage-900 group-hover:text-sage-600 transition-colors duration-300">
                        Bobi Ceramic's
                    </span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-8 text-base font-medium">
                    <a href="{{ route('home') }}"
                        class="relative text-sage-900 hover:text-sage-600 transition-colors duration-300 py-2 group">
                        Home
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-sage-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('produk') }}"
                        class="relative text-sage-900 hover:text-sage-600 transition-colors duration-300 py-2 group">
                        Produk
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-sage-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('tentang') }}"
                        class="relative text-sage-900 hover:text-sage-600 transition-colors duration-300 py-2 group">
                        Tentang Kami
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-sage-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('testimoni') }}"
                        class="relative text-sage-900 hover:text-sage-600 transition-colors duration-300 py-2 group">
                        Testimoni
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-sage-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('galeri') }}"
                        class="relative text-sage-900 hover:text-sage-600 transition-colors duration-300 py-2 group">
                        Galeri
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-sage-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('kontak') }}"
                        class="relative text-sage-900 hover:text-sage-600 transition-colors duration-300 py-2 group">
                        Contact
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-sage-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>

                {{-- <!-- Pemisah -->
                <div class="hidden lg:block w-px h-6 bg-sage-300 mx-4"></div> --}}

                <!-- Right Actions (Tombol di Kanan) -->
                {{-- <div class="flex items-center">
                <div class="hidden lg:block w-px h-6 bg-sage-300 mx-4"></div>
                <!-- Tombol Login (Desktop) -->
                <div class="hidden lg:flex items-center gap-2 mr-12">
                    <a href="{{ route('login') }}" class="px-5 py-2.5 text-base font-medium text-white bg-sage-600 hover:bg-sage-700 rounded-full transition-colors duration-300 shadow-sm">
                        Masuk
                    </a>
                </div>
            </div> --}}
                <!-- Right Actions (Tombol di Kanan) -->
                <div class="flex items-center mr-12">
                    <!-- Tombol Login & Register (Desktop) -->
                    {{-- <div class="hidden lg:flex items-center gap-4"> --}}
                    {{-- <button onclick="openModal('registerModal')" class="px-5 py-2 text-base font-medium text-sage-800 hover:bg-sage-100 rounded-full transition-colors duration-300">
                        Daftar
                    </button> --}}
                    <!-- Pemisah -->
                    {{-- <div class="hidden lg:block w-px h-6 bg-sage-300 mx-4"></div>
                    <button onclick="openModal('loginModal')" class="px-5 py-2 text-base font-medium text-white bg-sage-600 hover:bg-sage-700 rounded-full transition-colors duration-300 shadow-sm">
                        Masuk
                    </button> --}}
                    {{-- </div> --}}


                    <div class="hidden lg:flex items-center gap-4">
                        <!-- Pemisah -->
                        <div class="hidden lg:block w-px h-6 bg-sage-300 mx-4"></div>

                        @guest('customer')
                            <button onclick="openModal('loginModal')"
                                class="px-5 py-2 text-base font-medium text-white bg-sage-600 hover:bg-sage-700 rounded-full transition-colors duration-300 shadow-sm">
                                Masuk
                            </button>
                        @else
                            <span class="text-sage-800 font-medium">Hi, {{ Auth::guard('customer')->user()->name }}</span>
                            <form method="POST" action="{{ route('customer.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="px-5 py-2 text-base font-medium text-white bg-sage-600 hover:bg-red-700 rounded-full transition-colors duration-300 shadow-sm">
                                    Logout
                                </button>
                            </form>
                        @endguest
                    </div>


                    <!-- ... ikon kanan dan tombol mobile menu ... -->
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div class="mobile-menu lg:hidden border-t border-sage-100" id="mobileMenu">
                <div class="py-4 space-y-1">
                    <a href="{{ route('home') }}"
                        class="block px-4 py-3 text-base font-medium text-sage-900 hover:bg-sage-50 hover:text-sage-600 rounded-lg transition-all duration-300">Home</a>
                    <a href="{{ route('produk') }}"
                        class="block px-4 py-3 text-base font-medium text-sage-900 hover:bg-sage-50 hover:text-sage-600 rounded-lg transition-all duration-300">Produk</a>
                    <a href="{{ route('tentang') }}"
                        class="block px-4 py-3 text-base font-medium text-sage-900 hover:bg-sage-50 hover:text-sage-600 rounded-lg transition-all duration-300">Tentang
                        Kami</a>
                    <a href="{{ route('testimoni') }}"
                        class="block px-4 py-3 text-base font-medium text-sage-900 hover:bg-sage-50 hover:text-sage-600 rounded-lg transition-all duration-300">Testimoni</a>
                    <a href="{{ route('galeri') }}"
                        class="block px-4 py-3 text-base font-medium text-sage-900 hover:bg-sage-50 hover:text-sage-600 rounded-lg transition-all duration-300">Galeri</a>
                    <a href="{{ route('kontak') }}"
                        class="block px-4 py-3 text-base font-medium text-sage-900 hover:bg-sage-50 hover:text-sage-600 rounded-lg transition-all duration-300">Contact</a>

                    <!-- Tombol Login/Register Mobile -->
                    <div class="border-t border-sage-200 mt-4 pt-4 space-y-2">
                        <button onclick="openModal('loginModal')"
                            class="block w-full text-center px-4 py-3 text-base font-medium text-sage-800 bg-sage-100 hover:bg-sage-200 rounded-lg">
                            Masuk
                        </button>
                        <button onclick="openModal('registerModal')"
                            class="block w-full text-center px-4 py-3 text-base font-medium text-white bg-sage-600 hover:bg-sage-700 rounded-lg">
                            Daftar
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    {{-- Include Modal Login & Register --}}
    @include('auth.customer.login')
    @include('auth.customer.register')
    @include('auth.customer.lupa_password')




    <!-- Main Content -->
    <main>
        @yield('content')
    </main>




    <!-- Footer -->
    <footer class="bg-sage-900 text-white mt-20 sm:mt-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <!-- Footer Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10 mb-12">
                <!-- Brand Section -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-sage-400 to-sage-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">Bobi Ceramic's</span>
                    </div>
                    <p class="text-sage-300 text-sm leading-relaxed">
                        Mengatur ruang-ruang indah dengan karya-karya abadi yang menceritakan kisah Anda.
                    </p>
                    <div class="flex gap-3 pt-2">
                        <a href="#"
                            class="w-10 h-10 bg-sage-800 hover:bg-sage-600 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-sage-800 hover:bg-sage-600 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-sage-800 hover:bg-sage-600 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Toko Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Toko</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#"
                                class="text-sage-300 hover:text-white transition-colors duration-300">Semua Produk</a>
                        </li>
                        <li><a href="#"
                                class="text-sage-300 hover:text-white transition-colors duration-300">Produk Baru</a>
                        </li>
                        <li><a href="#"
                                class="text-sage-300 hover:text-white transition-colors duration-300">Terlaris</a></li>
                        <li><a href="#"
                                class="text-sage-300 hover:text-white transition-colors duration-300">Diskon</a></li>

                    </ul>
                </div>

                <!-- Customer Service -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Bantuan</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#"
                                class="text-sage-300 hover:text-white transition-colors duration-300">Hubungi Kami</a>
                        </li>
                        <li><a href="#"
                                class="text-sage-300 hover:text-white transition-colors duration-300">Pengiriman</a>
                        </li>
                        <li><a href="#"
                                class="text-sage-300 hover:text-white transition-colors duration-300">FAQ</a></li>
                        <li><a href="#"
                                class="text-sage-300 hover:text-white transition-colors duration-300">Lacak Pesanan</a>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Newsletter</h4>
                    <p class="text-sage-300 text-sm mb-4">Berlangganan penawaran dan pembaruan eksklusif.</p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Email Anda"
                            class="w-full px-4 py-2.5 rounded-lg bg-sage-800 border border-sage-700 text-white placeholder-sage-400 focus:outline-none focus:ring-2 focus:ring-sage-500 transition-all duration-300">
                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-sage-600 hover:bg-sage-500 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-sage-800 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sage-300 text-sm text-center sm:text-left">
                    &copy; {{ date('Y') }} Bobi Ceramic's. All rights reserved.
                </p>
                <div class="flex gap-6 text-sm text-sage-300">
                    <a href="#" class="hover:text-white transition-colors duration-300">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition-colors duration-300">Syarat Layanan</a>
                    <a href="#" class="hover:text-white transition-colors duration-300">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('active');
        }

        // --- MODAL SCRIPT (VERSI BARU DENGAN ANIMASI) ---
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('invisible', 'opacity-0');
            // Animate in
            setTimeout(() => {
                modal.querySelector('.modal-content').classList.remove('opacity-0', '-translate-y-10');
            }, 50); // delay kecil untuk memicu transisi
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const modalContent = modal.querySelector('.modal-content');

            // Animate out
            modalContent.classList.add('opacity-0', '-translate-y-10');
            modal.classList.add('opacity-0');

            setTimeout(() => {
                modal.classList.add('invisible');
                document.body.style.overflow = '';
            }, 300); // sinkronkan dengan durasi transisi
        }

        function switchModal(fromModalId, toModalId) {
            closeModal(fromModalId);
            setTimeout(() => openModal(toModalId), 150);
        }

        // Menutup modal saat mengklik area luar (backdrop)
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(event) {
                if (event.target === this) {
                    closeModal(this.id);
                }
            });
        });

        // Menutup modal saat menekan tombol Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                document.querySelectorAll('.modal:not(.invisible)').forEach(modal => {
                    closeModal(modal.id);
                });
            }
        });

        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobileMenu');
            const menuButton = event.target.closest('button[onclick="toggleMobileMenu()"]');

            if (!menuButton && !menu.contains(event.target) && menu.classList.contains('active')) {
                menu.classList.remove('active');
            }
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
