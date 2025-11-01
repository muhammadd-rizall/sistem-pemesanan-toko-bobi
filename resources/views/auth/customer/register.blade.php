<!-- =================================================================== -->
<!-- DESAIN BARU: MODAL REGISTER DUA PANEL -->
<!-- =================================================================== -->
<div id="registerModal"
    class="modal fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 invisible opacity-0">
    <div
        class="modal-content relative bg-white w-full max-w-4xl rounded-2xl shadow-2xl transform opacity-0 -translate-y-10 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2">

            <!-- 1. Panel Form (Kiri) -->
            <div class="p-8 md:p-12">
                <div class="flex justify-between items-start">
                    <h2 class="text-3xl font-bold text-sage-900">Daftar Akun Baru</h2>
                    <button onclick="closeModal('registerModal')"
                        class="p-2 -mt-2 -mr-4 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-full transition-colors">&times;</button>
                </div>
                <p class="mt-2 text-sage-600">Silahkan isi data diri Anda.</p>

                <form class="mt-8 space-y-4" action="{{ route('customer.register') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="register-name-panel" class="block text-sm font-medium text-sage-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input id="register-name-panel" name="name" type="text" value="{{ old('name') }}"
                            placeholder="Nama Lengkap"
                            class="w-full px-4 py-3 border {{ $errors->has('name') ? 'border-red-500' : 'border-sage-200' }} rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="register-username-panel" class="block text-sm font-medium text-sage-700 mb-1">
                            Username
                        </label>
                        <input id="register-username-panel" name="username" type="text" value="{{ old('username') }}"
                            placeholder="Username"
                            class="w-full px-4 py-3 border {{ $errors->has('username') ? 'border-red-500' : 'border-sage-200' }} rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500">
                        @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="register-email-panel" class="block text-sm font-medium text-sage-700 mb-1">
                            Email
                        </label>
                        <input id="register-email-panel" name="email" type="email" value="{{ old('email') }}"
                            placeholder="example@gmail.com"
                            class="w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-sage-200' }} rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="register-password-panel" class="block text-sm font-medium text-sage-700 mb-1">
                            Password
                        </label>
                        <input id="register-password-panel" name="password" type="password" placeholder="Password"
                            class="w-full px-4 py-3 border {{ $errors->has('password') ? 'border-red-500' : 'border-sage-200' }} rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500 pe-10">

                        <!-- Show/Hide Icon -->
                        <i class="fa-regular fa-eye absolute top-10 right-3 cursor-pointer text-gray-500 hover:text-gray-700"
                            onclick="togglePassword('register-password-panel', this)"></i>

                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="relative">
                        <label for="register-password-confirm-panel"
                            class="block text-sm font-medium text-sage-700 mb-1">
                            Konfirmasi Password
                        </label>
                        <input id="register-password-confirm-panel" name="password_confirmation" type="password"
                            placeholder="Konfirmasi Password"
                            class="w-full px-4 py-3 border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-sage-200' }} rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500 pe-10">

                        <!-- Show/Hide Icon -->
                        <i class="fa-regular fa-eye absolute top-10 right-3 cursor-pointer text-gray-500 hover:text-gray-700"
                            onclick="togglePassword('register-password-confirm-panel', this)"></i>

                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>



                    <div class="pt-2">
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 text-base font-bold rounded-lg text-white bg-sage-600 hover:bg-sage-700 transition-colors">
                            Daftar
                        </button>
                    </div>
                </form>
            </div>

            <!-- 2. Panel Gambar (Kanan) -->
            <div
                class="relative hidden md:flex flex-col items-center justify-center p-8 text-center text-white bg-sage-800">
                <img src="{{ asset('storage/images/register.jpg') }}" alt="Keramik"
                    class="absolute inset-0 w-full h-full object-cover opacity-30">
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold drop-shadow-lg">Sudah Punya Akun?</h2>
                    <p class="mt-4 text-gray-200 max-w-xs mx-auto">Jika Anda sudah terdaftar, silahkan login untuk
                        masuk ke akun Anda.</p>
                    <button onclick="switchModal('registerModal', 'loginModal')"
                        class="mt-8 px-8 py-3 bg-white/20 border border-white/30 backdrop-blur-md rounded-full hover:bg-white/30 transition-colors">
                        Masuk Di Sini
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script khusus untuk modal register -->
@if ($errors->has('name') || $errors->has('username') || $errors->has('password_confirmation'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerModal = document.getElementById('registerModal');
            if (registerModal) {
                registerModal.classList.remove('invisible', 'opacity-0');
                const modalContent = registerModal.querySelector('.modal-content');
                if (modalContent) {
                    modalContent.classList.remove('opacity-0', '-translate-y-10');
                }
            }
        });
    </script>
@endif

<script>
    function togglePassword(id, icon) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

@if(session('openLoginModal'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const registerModal = document.getElementById('registerModal');
    const loginModal = document.getElementById('loginModal');

    if(registerModal) {
        // Tutup modal register
        registerModal.querySelector('.modal-content')?.classList.add('-translate-y-10','opacity-0');
        registerModal.classList.add('invisible');
    }

    if(loginModal) {
        // Buka modal login
        loginModal.classList.remove('invisible','opacity-0');
        // Jalankan animasi smooth
        setTimeout(() => {
            loginModal.querySelector('.modal-content')?.classList.remove('-translate-y-10','opacity-0');
        }, 50);
    }

    // Pesan sukses
    @if(session('success'))
        alert("{{ session('success') }}");
    @endif
});
</script>
@endif



