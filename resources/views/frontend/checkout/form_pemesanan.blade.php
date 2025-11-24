@extends('frontend.layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Form Order -->
            <form id="order-form" action="{{ route('customer.orders.preview.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="customer_id" value="{{ auth()->guard('customer')->id() }}">

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
                                <svg class="w-6 h-6 text-[#7eb17e]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <h2 class="text-2xl font-bold text-gray-800">Detail Produk</h2>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex gap-4">
                                        <img src="{{ asset('storage/' . $product->gambar_produk) }}"
                                            alt="{{ $product->nama_produk }}" class="w-20 h-20 object-cover rounded-lg">
                                        <div>
                                            <h3 class="font-semibold text-lg text-gray-800">{{ $product->nama_produk }}</h3>
                                            <p class="text-2xl font-bold text-[#7eb17e] mt-2">Rp
                                                {{ number_format($product->harga_jual, 0, ',', '.') }}/pcs</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between border-t pt-4">
                                    <label class="font-medium text-gray-700">Jumlah:</label>
                                    <div class="flex items-center gap-3">
                                        <button type="button" id="decrease-qty"
                                            class="w-10 h-10 rounded-lg bg-gray-200 hover:bg-gray-300 font-bold text-xl transition">-</button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                                            max="{{ $product->stok }}"
                                            class="w-16 text-center font-bold text-xl border-2 border-gray-300 rounded-lg"
                                            readonly>
                                        <button type="button" id="increase-qty"
                                            class="w-10 h-10 rounded-lg bg-[#7eb17e] hover:bg-[#6da16d] text-white font-bold text-xl transition">+</button>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Subtotal:</span>
                                        <span id="subtotal" class="text-xl font-bold text-gray-800">Rp
                                            {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                            </div>
                        </div>

                        <!-- Discount -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <svg class="w-6 h-6 text-[#7eb17e]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                                <h2 class="text-2xl font-bold text-gray-800">Diskon</h2>
                            </div>

                            <div class="bg-green-50 rounded-lg p-4 flex justify-between items-center">
                                <span class="font-medium text-gray-700">Kode Diskon Berlaku:</span>
                                @php $diskonNilai = $diskon ? $diskon->nilai_diskon : 0; @endphp
                                @if ($diskon)
                                    <span id="discount_preview" class="text-xl font-bold text-green-600">
                                        {{ $diskon->kode_diskon }} - Rp
                                        {{ number_format($diskon->nilai_diskon, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span id="discount_preview" class="text-xl font-bold text-green-600">Rp 0</span>
                                @endif

                                <input type="hidden" name="total_diskon" value="{{ $diskonNilai }}">
                            </div>
                        </div>

                        <!-- Contact Info & Address -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <svg class="w-6 h-6 text-[#7eb17e]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <h2 class="text-2xl font-bold text-gray-800">Informasi Kontak</h2>
                            </div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp <span
                                    class="text-red-500">*</span></label>
                            <div class="relative mb-4">
                                <span class="absolute left-4 top-3.5 text-gray-600 font-medium">+62</span>
                                <input type="tel" id="no_hp" name="no_hp" required
                                    class="w-full pl-14 pr-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#7eb17e] focus:outline-none transition"
                                    placeholder="812 3456 7890" pattern="[0-9]{9,13}" maxlength="13"
                                    value="{{ old('no_hp') }}">
                            </div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Pengiriman <span
                                    class="text-red-500">*</span></label>
                            <textarea id="alamat_pengiriman" name="alamat_pengiriman" rows="4" required
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#7eb17e] focus:outline-none transition"
                                placeholder="Jl. Contoh No. 123, RT/RW, Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos">{{ old('alamat_pengiriman') }}</textarea>

                            <label class="block text-sm font-semibold text-gray-700 mb-2 mt-4">Catatan Tambahan</label>
                            <textarea id="catatan" name="catatan" rows="4"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#7eb17e] focus:outline-none transition"
                                placeholder="Tambahkan catatan untuk pesanan Anda (opsional)">{{ old('catatan') }}</textarea>
                        </div>
                    </div>

                    <!-- Sidebar Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Ringkasan Pesanan</h2>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Total Harga Awal</span>
                                    <span id="total-harga-awal" class="font-semibold">Rp
                                        {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Diskon</span>
                                    <span id="total-diskon" class="font-semibold text-green-600">- Rp
                                        {{ number_format($diskonNilai, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Biaya Pengiriman</span>
                                    <span class="font-semibold text-green-600">Gratis</span>
                                </div>
                                <div class="border-t-2 border-gray-200 pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-gray-800">Total Akhir</span>
                                        <span id="total-harga-akhir" class="text-2xl font-bold text-[#7eb17e]">Rp
                                            {{ number_format($product->harga_jual - $diskonNilai, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>


                            
                            <!-- Tombol Submit ke Preview -->
                            <button type="submit"
                                class="w-full bg-[#7eb17e] hover:bg-[#6da16d] text-white font-bold text-lg py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center justify-center gap-2">
                                Lanjut ke Rincian Pesanan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const productPrice = {{ $product->harga_jual }};
            const quantityInput = document.getElementById('quantity');
            const decreaseBtn = document.getElementById('decrease-qty');
            const increaseBtn = document.getElementById('increase-qty');
            const subtotalEl = document.getElementById('subtotal');
            const totalAwalEl = document.getElementById('total-harga-awal');
            const totalAkhirEl = document.getElementById('total-harga-akhir');
            const discountValue = {{ $diskonNilai }};

            function updatePrices() {
                const qty = parseInt(quantityInput.value);
                const subtotal = productPrice * qty;
                subtotalEl.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                totalAwalEl.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                totalAkhirEl.innerText = 'Rp ' + (subtotal - discountValue).toLocaleString('id-ID');
            }

            decreaseBtn.addEventListener('click', () => {
                let qty = parseInt(quantityInput.value);
                if (qty > 1) {
                    quantityInput.value = qty - 1;
                    updatePrices();
                }
            });
            increaseBtn.addEventListener('click', () => {
                let qty = parseInt(quantityInput.value);
                if (qty < {{ $product->stok }}) {
                    quantityInput.value = qty + 1;
                    updatePrices();
                }
            });
        </script>
    @endpush
@endsection
