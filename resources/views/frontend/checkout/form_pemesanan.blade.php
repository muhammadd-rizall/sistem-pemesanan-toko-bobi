@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Form Pemesanan</h1>
            <p class="text-gray-600">Lengkapi data di bawah untuk melanjutkan pesanan Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Product Info -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-6 h-6 text-[#7eb17e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Detail Produk</h2>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex gap-4">
                                <img src="{{ asset('storage/' . $product->gambar_produk) }}" alt="{{ $product->nama_produk }}" class="w-20 h-20 object-cover rounded-lg">
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">{{ $product->nama_produk }}</h3>
                                    <p class="text-2xl font-bold text-[#7eb17e] mt-2">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}/pcs</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between border-t pt-4">
                            <label class="font-medium text-gray-700">Jumlah:</label>
                            <div class="flex items-center gap-3">
                                <button type="button" id="decrease-qty" class="w-10 h-10 rounded-lg bg-gray-200 hover:bg-gray-300 font-bold text-xl transition">-</button>
                                <input type="number" id="quantity" value="1" min="1" max="{{ $product->stok }}" class="w-16 text-center font-bold text-xl border-2 border-gray-300 rounded-lg" readonly>
                                <button type="button" id="increase-qty" class="w-10 h-10 rounded-lg bg-[#7eb17e] hover:bg-[#6da16d] text-white font-bold text-xl transition">+</button>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Subtotal:</span>
                                <span id="subtotal" class="text-xl font-bold text-gray-800">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-6 h-6 text-[#7eb17e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Informasi Kontak</h2>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-gray-600 font-medium">+62</span>
                            <input type="tel" id="no_hp" name="no_hp" required
                                class="w-full pl-14 pr-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#7eb17e] focus:outline-none transition"
                                placeholder="812 3456 7890" pattern="[0-9]{9,13}" maxlength="13">
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Nomor akan digunakan untuk konfirmasi pesanan</p>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-6 h-6 text-[#7eb17e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Alamat Pengiriman</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea id="alamat_pengiriman" name="alamat_pengiriman" rows="4" required
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#7eb17e] focus:outline-none transition"
                                placeholder="Jl. Contoh No. 123, RT/RW, Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos"></textarea>
                            <p class="text-sm text-gray-500 mt-1">Masukkan alamat lengkap termasuk kota, provinsi, dan kode pos</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-6 h-6 text-[#7eb17e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Metode Pembayaran</h2>
                    </div>

                    <div class="space-y-4">
                        <!-- Bank Transfer -->
                        <div class="border-2 border-gray-200 rounded-xl p-4 hover:border-[#7eb17e] transition cursor-pointer" id="bank-container">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="payment_method" value="bank_transfer" class="w-5 h-5 text-[#7eb17e] focus:ring-[#7eb17e]" id="bank-radio" checked>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-gray-800">Transfer Bank</span>
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <div id="bank-options" class="mt-4 ml-9 space-y-2">
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                    <input type="radio" name="bank_name" value="BNI" class="w-4 h-4 text-[#7eb17e]">
                                    <span class="ml-3 text-gray-700 font-medium">BNI</span>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                    <input type="radio" name="bank_name" value="BRI" class="w-4 h-4 text-[#7eb17e]">
                                    <span class="ml-3 text-gray-700 font-medium">BRI</span>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                    <input type="radio" name="bank_name" value="BCA" class="w-4 h-4 text-[#7eb17e]">
                                    <span class="ml-3 text-gray-700 font-medium">BCA</span>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                    <input type="radio" name="bank_name" value="Mandiri" class="w-4 h-4 text-[#7eb17e]">
                                    <span class="ml-3 text-gray-700 font-medium">Mandiri</span>
                                </label>
                            </div>
                        </div>

                        <!-- E-Wallet -->
                        <div class="border-2 border-gray-200 rounded-xl p-4 hover:border-[#7eb17e] transition cursor-pointer" id="ewallet-container">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="payment_method" value="e_wallet" class="w-5 h-5 text-[#7eb17e] focus:ring-[#7eb17e]" id="ewallet-radio">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-gray-800">E-Wallet</span>
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <div id="ewallet-options" class="mt-4 ml-9 space-y-2" style="display: none;">
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                    <input type="radio" name="ewallet_name" value="Dana" class="w-4 h-4 text-[#7eb17e]">
                                    <span class="ml-3 text-gray-700 font-medium">Dana</span>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                    <input type="radio" name="ewallet_name" value="OVO" class="w-4 h-4 text-[#7eb17e]">
                                    <span class="ml-3 text-gray-700 font-medium">OVO</span>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                    <input type="radio" name="ewallet_name" value="GoPay" class="w-4 h-4 text-[#7eb17e]">
                                    <span class="ml-3 text-gray-700 font-medium">GoPay</span>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                    <input type="radio" name="ewallet_name" value="ShopeePay" class="w-4 h-4 text-[#7eb17e]">
                                    <span class="ml-3 text-gray-700 font-medium">ShopeePay</span>
                                </label>
                            </div>
                        </div>

                        <!-- QRIS -->
                        <div class="border-2 border-gray-200 rounded-xl p-4 hover:border-[#7eb17e] transition cursor-pointer">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="payment_method" value="qris" class="w-5 h-5 text-[#7eb17e] focus:ring-[#7eb17e]">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-gray-800">QRIS</span>
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">Scan QR code untuk pembayaran</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-6 h-6 text-[#7eb17e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Catatan Tambahan</h2>
                    </div>

                    <textarea id="catatan" name="catatan" rows="4"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#7eb17e] focus:outline-none transition"
                        placeholder="Tambahkan catatan untuk pesanan Anda (opsional)"></textarea>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Ringkasan Pesanan</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Harga Awal</span>
                            <span id="total-harga-awal" class="font-semibold">Rp 0</span>
                        </div>

                        <div class="flex justify-between text-gray-600">
                            <span>Diskon</span>
                            <span id="total-diskon" class="font-semibold text-green-600">- Rp 0</span>
                        </div>

                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Pengiriman</span>
                            <span class="font-semibold text-green-600">Gratis</span>
                        </div>

                        <div class="border-t-2 border-gray-200 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-800">Total Akhir</span>
                                <span id="total-harga-akhir" class="text-2xl font-bold text-[#7eb17e]">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="submit-order"
                        class="w-full bg-[#7eb17e] hover:bg-[#6da16d] text-white font-bold text-lg py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Konfirmasi Pesanan
                    </button>

                    <div class="mt-6 p-4 bg-green-50 rounded-lg">
                        <p class="text-sm text-gray-600 text-center">
                            <span class="font-semibold text-green-700">✓</span> Status pembayaran: <strong>Pending</strong>
                        </p>
                        <p class="text-sm text-gray-600 text-center mt-2">
                            Pesanan akan diproses dalam 1-2 hari kerja
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const productPrice = {{ $product->harga_jual }};
    const quantityInput = document.getElementById('quantity');
    const decreaseBtn = document.getElementById('decrease-qty');
    const increaseBtn = document.getElementById('increase-qty');
    const subtotalEl = document.getElementById('subtotal');
    const totalHargaAwalEl = document.getElementById('total-harga-awal');
    const totalDiskonEl = document.getElementById('total-diskon');
    const totalHargaAkhirEl = document.getElementById('total-harga-akhir');

    // Payment method elements
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const bankOptions = document.getElementById('bank-options');
    const ewalletOptions = document.getElementById('ewallet-options');
    const bankRadio = document.getElementById('bank-radio');
    const ewalletRadio = document.getElementById('ewallet-radio');
    const bankContainer = document.getElementById('bank-container');
    const ewalletContainer = document.getElementById('ewallet-container');

    // Function to toggle payment options
    function togglePaymentOptions() {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;

        if (selectedMethod === 'bank_transfer') {
            bankOptions.style.display = 'block';
            ewalletOptions.style.display = 'none';
        } else if (selectedMethod === 'e_wallet') {
            bankOptions.style.display = 'none';
            ewalletOptions.style.display = 'block';
        } else {
            bankOptions.style.display = 'none';
            ewalletOptions.style.display = 'none';
        }
    }

    // Handle payment method changes
    paymentMethods.forEach(method => {
        method.addEventListener('change', togglePaymentOptions);
    });

    // Handle container clicks
    bankContainer.addEventListener('click', function(e) {
        if (e.target.type !== 'radio') {
            bankRadio.checked = true;
            togglePaymentOptions();
        }
    });

    ewalletContainer.addEventListener('click', function(e) {
        if (e.target.type !== 'radio') {
            ewalletRadio.checked = true;
            togglePaymentOptions();
        }
    });

    // Initialize on page load
    togglePaymentOptions();

    function formatRupiah(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    }

    function updateTotal() {
        const qty = parseInt(quantityInput.value);
        const totalHargaAwal = productPrice * qty;
        const diskon = 0;
        const totalHargaAkhir = totalHargaAwal - diskon;

        subtotalEl.textContent = formatRupiah(totalHargaAwal);
        totalHargaAwalEl.textContent = formatRupiah(totalHargaAwal);
        totalDiskonEl.textContent = '- ' + formatRupiah(diskon);
        totalHargaAkhirEl.textContent = formatRupiah(totalHargaAkhir);
    }

    decreaseBtn.addEventListener('click', () => {
        let qty = parseInt(quantityInput.value);
        if (qty > 1) {
            quantityInput.value = qty - 1;
            updateTotal();
        }
    });

    increaseBtn.addEventListener('click', () => {
        let qty = parseInt(quantityInput.value);
        const maxStock = parseInt(quantityInput.max);
        if (qty < maxStock) {
            quantityInput.value = qty + 1;
            updateTotal();
        }
    });

    document.getElementById('submit-order').addEventListener('click', async () => {
        const noHp = document.getElementById('no_hp').value;
        const alamat = document.getElementById('alamat_pengiriman').value;
        const catatan = document.getElementById('catatan').value;
        const qty = parseInt(quantityInput.value);
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        let metode_pembayaran = '';
        if (paymentMethod === 'bank_transfer') {
            const bankName = document.querySelector('input[name="bank_name"]:checked');
            if (!bankName) {
                alert('Pilih bank untuk transfer!');
                return;
            }
            metode_pembayaran = 'Bank Transfer - ' + bankName.value;
        } else if (paymentMethod === 'e_wallet') {
            const ewalletName = document.querySelector('input[name="ewallet_name"]:checked');
            if (!ewalletName) {
                alert('Pilih e-wallet!');
                return;
            }
            metode_pembayaran = 'E-Wallet - ' + ewalletName.value;
        } else {
            metode_pembayaran = 'QRIS';
        }

        if (!noHp.trim()) {
            alert('Nomor WhatsApp wajib diisi!');
            return;
        }

        if (!alamat.trim()) {
            alert('Alamat pengiriman wajib diisi!');
            return;
        }

        const totalHargaAwal = productPrice * qty;
        const totalDiskon = 0;
        const totalHargaAkhir = totalHargaAwal - totalDiskon;

        const orderData = {
            product_id: {{ $product->id }},
            quantity: qty,
            no_hp: '+62' + noHp,
            alamat_pengiriman: alamat,
            catatan: catatan,
            metode_pembayaran: metode_pembayaran,
            total_harga_awal: totalHargaAwal,
            total_diskon: totalDiskon,
            total_harga_akhir: totalHargaAkhir,
            _token: '{{ csrf_token() }}'
        };

        try {
            const response = await fetch('{{ route("customer.orders.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(orderData)
            });

            const result = await response.json();

            if (result.success) {
                alert('Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
                window.location.href = '{{ route("customer.dashboard") }}';
            } else {
                alert('Gagal membuat pesanan: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses pesanan');
        }
    });

    // Initialize total on page load
    updateTotal();
</script>
@endpush
@endsection
