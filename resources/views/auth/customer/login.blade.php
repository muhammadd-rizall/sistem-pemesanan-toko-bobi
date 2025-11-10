<!-- =================================================================== -->
<!-- MODAL LOGIN DUA PANEL -->
<!-- =================================================================== -->
<div id="loginModal"
    class="modal fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 invisible opacity-0 transition-all duration-300">

    <div
        class="modal-content relative bg-white w-full max-w-4xl rounded-2xl shadow-2xl transform opacity-0 -translate-y-10 overflow-hidden transition-all duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2">

            <!-- Panel Kiri -->
            <div
                class="relative hidden md:flex flex-col items-center justify-center p-8 text-center text-white bg-sage-800">
                <img src="{{ asset('storage/images/login.jpg') }}" alt="Keramik"
                    class="absolute inset-0 w-full h-full object-cover opacity-30">
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold drop-shadow-lg">Selamat Datang Kembali!</h2>
                    <p class="mt-4 text-gray-200 max-w-xs mx-auto">
                        Jika Anda sudah memiliki akun, silahkan login untuk melanjutkan.
                    </p>
                    <button type="button" onclick="switchModal('loginModal', 'registerModal')"
                        class="mt-8 px-8 py-3 bg-white/20 border border-white/30 backdrop-blur-md rounded-full hover:bg-white/30 transition-colors">
                        Buat Akun Baru
                    </button>
                </div>
            </div>

            <!-- Panel Kanan -->
            <div class="p-8 md:p-12">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h2 class="text-3xl font-bold text-sage-900">Masuk</h2>
                        <p class="mt-2 text-sage-600">Silahkan masukkan detail akun Anda.</p>
                    </div>
                    <button type="button" onclick="closeModal('loginModal')"
                        class="p-2 -mt-2 -mr-4 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-full transition-colors text-2xl leading-none">
                        &times;
                    </button>
                </div>

                <!-- Alert Sukses -->
                @if (session('registerSuccess'))
                    <div id="successAlert"
                        class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg animate-fadeIn transition-opacity duration-700">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-green-700 text-sm font-medium">
                                {{ session('reset_success') ?? session('registerSuccess') }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form class="mt-6 space-y-6" action="{{ route('customer.login') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="login-email-panel" class="block text-sm font-medium text-sage-700 mb-1">
                            Email
                        </label>
                        <input id="login-email-panel" name="email" type="email" value="{{ old('email') }}"
                            placeholder="example@gmail.com"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500 {{ $errors->has('email') ? 'border-red-500' : 'border-sage-200' }}">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="login-password-panel" class="block text-sm font-medium text-sage-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <input id="login-password-panel" name="password" type="password" placeholder="Password"
                                class="w-full px-4 py-3 pr-10 border rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500 {{ $errors->has('password') ? 'border-red-500' : 'border-sage-200' }}">
                            <i class="fa-regular fa-eye absolute top-1/2 -translate-y-1/2 right-3 cursor-pointer text-gray-500 hover:text-gray-700"
                                onclick="togglePassword('login-password-panel', this)"></i>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-sage-600 border-sage-300 rounded focus:ring-sage-500">
                            <span class="ml-2 text-sm text-sage-600">Ingat Saya</span>
                        </label>
                        <button type="button" onclick="switchModal('loginModal', 'lupaPasswordModal')"
                            class="text-sm text-sage-600 hover:text-sage-700 hover:underline">
                            Lupa Password?
                        </button>
                    </div>

                    <!-- Tombol -->
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-3 px-4 text-base font-bold rounded-lg text-white bg-sage-600 hover:bg-sage-700 focus:outline-none focus:ring-2 focus:ring-sage-500 focus:ring-offset-2 transition-colors">
                            Masuk
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Atau lanjutkan dengan</span>
                        </div>
                    </div>

                    <!-- Login Google -->
                    <div class="flex justify-center">
                        <a href="{{ route('customer.google.redirect') }}"
                            class="inline-flex items-center justify-center gap-3 px-6 py-3 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sage-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.9895 10.1871C19.9895 9.36767 19.9214 8.76973 19.7742 8.14966H10.1992V11.848H15.8195C15.7062 12.7671 15.0943 14.1512 13.7346 15.0813L13.7155 15.2051L16.7429 17.4969L16.9527 17.5174C18.879 15.7789 19.9895 13.221 19.9895 10.1871Z"
                                    fill="#4285F4" />
                                <path
                                    d="M10.1993 19.9313C12.9527 19.9313 15.2643 19.0454 16.9527 17.5174L13.7346 15.0813C12.8734 15.6682 11.7176 16.0779 10.1993 16.0779C7.50243 16.0779 5.21352 14.3395 4.39759 11.9366L4.27799 11.9466L1.13003 14.3273L1.08887 14.4391C2.76588 17.6945 6.21061 19.9313 10.1993 19.9313Z"
                                    fill="#34A853" />
                                <path
                                    d="M4.39748 11.9366C4.18219 11.3166 4.05759 10.6521 4.05759 9.96565C4.05759 9.27909 4.18219 8.61473 4.38615 7.99466L4.38045 7.8626L1.19304 5.44366L1.08875 5.49214C0.397576 6.84305 0.000976562 8.36008 0.000976562 9.96565C0.000976562 11.5712 0.397576 13.0882 1.08875 14.4391L4.39748 11.9366Z"
                                    fill="#FBBC05" />
                                <path
                                    d="M10.1993 3.85336C12.1142 3.85336 13.406 4.66168 14.1425 5.33717L17.0207 2.59107C15.253 0.985496 12.9527 0 10.1993 0C6.2106 0 2.76588 2.23672 1.08887 5.49214L4.38626 7.99466C5.21352 5.59183 7.50242 3.85336 10.1993 3.85336Z"
                                    fill="#EB4335" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Login dengan Google</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script: Auto show modal jika sukses -->
@if (session('openLoginModal') || session('registerSuccess'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            openModal('loginModal');

            // Auto fade alert setelah 5 detik
            const alert = document.getElementById('successAlert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 700); // hapus elemen setelah animasi
                }, 5000);
            }
        });
    </script>
@endif

<script>
    // Toggle Password Visibility
    function togglePassword(inputId, iconElement) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            iconElement.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            iconElement.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Helper: buka modal dengan transisi
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('invisible', 'opacity-0');
            const modalContent = modal.querySelector('.modal-content');
            setTimeout(() => modalContent.classList.remove('-translate-y-10', 'opacity-0'), 50);
        }
    }
</script>

<style>
    /* Animasi Alert */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.4s ease forwards;
    }
</style>
