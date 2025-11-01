<!-- =================================================================== -->
<!-- MODAL LUPA PASSWORD OTP (3 STEPS) - FIXED VERSION -->
<!-- =================================================================== -->

<!-- Pastikan di <head> ada meta tag ini -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="lupaPasswordModal"
    class="modal fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 invisible opacity-0 transition-all duration-300">

    <div
        class="modal-content relative bg-white w-full max-w-4xl rounded-2xl shadow-2xl transform opacity-0 -translate-y-10 overflow-hidden transition-all duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2">

            <!-- Panel Kiri: Gambar & Message -->
            <div
                class="relative hidden md:flex flex-col items-center justify-center p-8 text-center text-white bg-sage-800">
                <div class="absolute inset-0 bg-gradient-to-br from-sage-700 to-sage-900 opacity-90"></div>

                <div class="relative z-10">
                    <div class="mb-6">
                        <svg class="w-20 h-20 mx-auto text-white/80" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-4xl font-bold drop-shadow-lg">
                        Reset Password
                    </h2>
                    <p class="mt-4 text-gray-200 max-w-xs mx-auto">
                        Kami akan mengirimkan kode OTP ke email Anda untuk verifikasi.
                    </p>

                    <!-- Step Indicator -->
                    <div class="mt-8 flex justify-center gap-2">
                        <div id="step-indicator-1" class="w-3 h-3 rounded-full bg-white"></div>
                        <div id="step-indicator-2" class="w-3 h-3 rounded-full bg-white/30"></div>
                        <div id="step-indicator-3" class="w-3 h-3 rounded-full bg-white/30"></div>
                    </div>
                </div>
            </div>

            <!-- Panel Kanan: Forms -->
            <div class="p-8 md:p-12">
                <!-- Header -->
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h2 id="modalTitle" class="text-3xl font-bold text-sage-900">Lupa Password?</h2>
                        <p id="modalSubtitle" class="mt-2 text-sage-600">Masukkan email Anda untuk menerima kode OTP.
                        </p>
                    </div>
                    <button type="button" onclick="closeModal('lupaPasswordModal')"
                        class="p-2 -mt-2 -mr-4 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-full transition-colors text-2xl leading-none">
                        &times;
                    </button>
                </div>

                <!-- Alert Success -->
                <div id="successAlert" class="hidden mt-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-green-700 text-sm font-medium" id="successMessage"></p>
                    </div>
                </div>

                <!-- Alert Error -->
                <div id="errorAlert" class="hidden mt-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-red-700 text-sm font-medium" id="errorMessage"></p>
                    </div>
                </div>

                <!-- STEP 1: Email Form -->
                <form id="step1Form" class="mt-8 space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-sage-700 mb-1">
                            Email
                        </label>
                        <div class="relative">
                            <input id="email" name="email" type="email" required placeholder="example@gmail.com"
                                class="w-full px-4 py-3 border border-sage-200 rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500">
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-3 px-4 text-base font-bold rounded-lg text-white bg-sage-600 hover:bg-sage-700 focus:outline-none focus:ring-2 focus:ring-sage-500 focus:ring-offset-2 transition-colors">
                            <span class="btn-text">Kirim Kode OTP</span>
                            <span class="btn-loader hidden">Mengirim...</span>
                        </button>
                    </div>

                    <div class="text-center">
                        <button type="button" onclick="closeModal('lupaPasswordModal')"
                            class="text-sm text-sage-600 hover:text-sage-700 hover:underline inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Login
                        </button>
                    </div>
                </form>

                <!-- STEP 2: OTP Verification Form -->
                <form id="step2Form" class="hidden mt-8 space-y-6">
                    <div>
                        <label for="otp" class="block text-sm font-medium text-sage-700 mb-1">
                            Kode OTP (6 digit)
                        </label>
                        <input id="otp" name="otp" type="text" maxlength="6" pattern="[0-9]{6}" required
                            placeholder="000000"
                            class="w-full px-4 py-3 text-center text-2xl tracking-widest font-bold border border-sage-200 rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500">
                        <p class="mt-2 text-xs text-sage-500">
                            Kode OTP telah dikirim ke <span id="emailDisplay" class="font-semibold"></span>
                        </p>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-3 px-4 text-base font-bold rounded-lg text-white bg-sage-600 hover:bg-sage-700 focus:outline-none focus:ring-2 focus:ring-sage-500 focus:ring-offset-2 transition-colors">
                            <span class="btn-text">Verifikasi OTP</span>
                            <span class="btn-loader hidden">Memverifikasi...</span>
                        </button>
                    </div>

                    <div class="text-center space-y-2">
                        <button type="button" id="resendBtn" onclick="resendOtp()"
                            class="text-sm text-sage-600 hover:text-sage-700 hover:underline">
                            Kirim ulang kode OTP
                        </button>
                        <br>
                        <button type="button" onclick="backToStep1()"
                            class="text-sm text-gray-500 hover:text-gray-700 hover:underline inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Ubah email
                        </button>
                    </div>
                </form>

                <!-- STEP 3: Reset Password Form -->
                <form id="step3Form" class="hidden mt-8 space-y-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-sage-700 mb-1">
                            Password Baru
                        </label>
                        <input id="password" name="password" type="password" minlength="6" required
                            placeholder="Minimal 6 karakter"
                            class="w-full px-4 py-3 border border-sage-200 rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-sage-700 mb-1">
                            Konfirmasi Password
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            minlength="6" required placeholder="Ketik ulang password"
                            class="w-full px-4 py-3 border border-sage-200 rounded-lg focus:outline-none focus:ring-sage-500 focus:border-sage-500">
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-3 px-4 text-base font-bold rounded-lg text-white bg-sage-600 hover:bg-sage-700 focus:outline-none focus:ring-2 focus:ring-sage-500 focus:ring-offset-2 transition-colors">
                            <span class="btn-text">Reset Password</span>
                            <span class="btn-loader hidden">Mereset...</span>
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<script>
    let userEmail = '';
    let currentStep = 1;

    //  Ambil CSRF token dari meta tag
    function getCsrfToken() {
        const token = document.querySelector('meta[name="csrf-token"]');
        if (!token) {
            console.error('CSRF token not found! Pastikan ada <meta name="csrf-token"> di <head>');
            return '';
        }
        return token.getAttribute('content');
    }

    // Modal Functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('invisible', 'opacity-0');
        setTimeout(() => {
            modal.querySelector('.modal-content').classList.remove('opacity-0', '-translate-y-10');
        }, 10);
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = modal.querySelector('.modal-content');
        content.classList.add('opacity-0', '-translate-y-10');
        setTimeout(() => {
            modal.classList.add('invisible', 'opacity-0');
            resetModal();
        }, 300);
    }

    function resetModal() {
        currentStep = 1;
        userEmail = '';
        document.getElementById('step1Form').classList.remove('hidden');
        document.getElementById('step2Form').classList.add('hidden');
        document.getElementById('step3Form').classList.add('hidden');
        hideAlerts();
        updateStepIndicators();
        document.getElementById('step1Form').reset();
    }

    function hideAlerts() {
        document.getElementById('successAlert').classList.add('hidden');
        document.getElementById('errorAlert').classList.add('hidden');
    }

    function showSuccess(message) {
        hideAlerts();
        document.getElementById('successMessage').textContent = message;
        document.getElementById('successAlert').classList.remove('hidden');
    }

    function showError(message) {
        hideAlerts();
        document.getElementById('errorMessage').textContent = message;
        document.getElementById('errorAlert').classList.remove('hidden');
    }

    function updateStepIndicators() {
        for (let i = 1; i <= 3; i++) {
            const indicator = document.getElementById(`step-indicator-${i}`);
            if (i === currentStep) {
                indicator.classList.remove('bg-white/30');
                indicator.classList.add('bg-white');
            } else {
                indicator.classList.remove('bg-white');
                indicator.classList.add('bg-white/30');
            }
        }
    }

    function goToStep(step) {
        currentStep = step;
        document.getElementById('step1Form').classList.add('hidden');
        document.getElementById('step2Form').classList.add('hidden');
        document.getElementById('step3Form').classList.add('hidden');

        document.getElementById(`step${step}Form`).classList.remove('hidden');
        updateStepIndicators();

        const titles = {
            1: {
                title: 'Lupa Password?',
                subtitle: 'Masukkan email Anda untuk menerima kode OTP.'
            },
            2: {
                title: 'Verifikasi OTP',
                subtitle: 'Masukkan 6 digit kode OTP yang telah dikirim ke email Anda.'
            },
            3: {
                title: 'Buat Password Baru',
                subtitle: 'Masukkan password baru untuk akun Anda.'
            }
        };

        document.getElementById('modalTitle').textContent = titles[step].title;
        document.getElementById('modalSubtitle').textContent = titles[step].subtitle;
        hideAlerts();
    }

    function backToStep1() {
        goToStep(1);
    }

    // STEP 1: Send OTP
    document.getElementById('step1Form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        const btnText = btn.querySelector('.btn-text');
        const btnLoader = btn.querySelector('.btn-loader');

        hideAlerts();
        btn.disabled = true;
        btnText.classList.add('hidden');
        btnLoader.classList.remove('hidden');

        userEmail = document.getElementById('email').value;

        const formData = new FormData();
        formData.append('email', userEmail);

        try {
            const response = await fetch('/forgot-password/send-otp', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                showSuccess(data.message);
                document.getElementById('emailDisplay').textContent = userEmail;
                setTimeout(() => goToStep(2), 1500);
            } else {
                showError(data.message || 'Email tidak ditemukan.');
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Terjadi kesalahan. Silakan coba lagi.');
        } finally {
            btn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoader.classList.add('hidden');
        }
    });

    // STEP 2: Verify OTP
    document.getElementById('step2Form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        const btnText = btn.querySelector('.btn-text');
        const btnLoader = btn.querySelector('.btn-loader');

        hideAlerts();
        btn.disabled = true;
        btnText.classList.add('hidden');
        btnLoader.classList.remove('hidden');

        const otp = document.getElementById('otp').value;

        const formData = new FormData();
        formData.append('email', userEmail);
        formData.append('otp', otp);

        try {
            const response = await fetch('/forgot-password/verify-otp', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                showSuccess(data.message);
                setTimeout(() => goToStep(3), 1500);
            } else {
                showError(data.message || 'Kode OTP salah atau sudah kadaluarsa.');
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Terjadi kesalahan. Silakan coba lagi.');
        } finally {
            btn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoader.classList.add('hidden');
        }
    });

    // STEP 3: Reset Password
    document.getElementById('step3Form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        const btnText = btn.querySelector('.btn-text');
        const btnLoader = btn.querySelector('.btn-loader');

        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        if (password !== passwordConfirmation) {
            showError('Password dan konfirmasi password tidak cocok.');
            return;
        }

        hideAlerts();
        btn.disabled = true;
        btnText.classList.add('hidden');
        btnLoader.classList.remove('hidden');

        const formData = new FormData();
        formData.append('email', userEmail);
        formData.append('password', password);
        formData.append('password_confirmation', passwordConfirmation);

        try {
            const response = await fetch('/forgot-password/reset', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                showSuccess(data.message);

                setTimeout(() => {
                    const lupaModal = document.getElementById('lupaPasswordModal');
                    const lupaContent = lupaModal.querySelector('.modal-content');
                    lupaContent.classList.add('opacity-0', '-translate-y-10');
                    setTimeout(() => lupaModal.classList.add('invisible'), 300);

                    openModal('loginModal');
                }, 1500);
            } else {
                showError(data.message || 'Gagal mereset password.');
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Terjadi kesalahan. Silakan coba lagi.');
        } finally {
            btn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoader.classList.add('hidden');
        }
    });

    // Resend OTP dengan endpoint yang benar dan debounce
    let resendTimeout = null;
    async function resendOtp() {
        const btn = document.getElementById('resendBtn');

        //  Prevent double-click
        if (btn.disabled) return;

        const originalText = btn.textContent;
        btn.disabled = true;
        btn.textContent = 'Mengirim ulang...';

        const formData = new FormData();
        formData.append('email', userEmail);

        try {
            //  Gunakan endpoint yang sama dengan send-otp
            const response = await fetch('/forgot-password/resend-otp', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                showSuccess(data.message);

                let countdown = 60;
                const countdownInterval = setInterval(() => {
                    countdown--;
                    btn.textContent = `Kirim ulang (${countdown}s)`;
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        btn.textContent = originalText;
                        btn.disabled = false;
                    }
                }, 1000);
            } else {
                showError(data.message || 'Gagal mengirim ulang OTP.');
                btn.disabled = false;
                btn.textContent = originalText;
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Terjadi kesalahan. Silakan coba lagi.');
            btn.disabled = false;
            btn.textContent = originalText;
        }
    }
</script>
