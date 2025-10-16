<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari URL
        $search = $request->input('search');

        // 2. Definisikan SEMUA produk (ini akan kita gunakan untuk pencarian)
        $allProducts = [
            ['id' => 1, 'name' => 'Keramik Lantai Motif Kayu', 'price' => 'Rp 249.000', 'image' => asset('storage/products/keramik.jpeg'), 'merek' => 'Granito', 'deskripsi' => 'Keramik lantai berkualitas tinggi...'],
            ['id' => 2, 'name' => 'Wastafel Gantung Minimalis', 'price' => 'Rp 189.000', 'image' => asset('storage/products/wastafel.jpg'), 'merek' => 'Toto', 'deskripsi' => 'Desain hemat tempat...'],
            ['id' => 3, 'name' => 'Shower Mandi Tipe Raindance', 'price' => 'Rp 320.000', 'image' => asset('storage/products/shower.jpg'), 'merek' => 'Wasser', 'deskripsi' => 'Nikmati sensasi mandi hujan...'],
            ['id' => 4, 'name' => 'Pintu Kamar Mandi PVC', 'price' => 'Rp 450.000', 'image' => asset('storage/products/pintu.jpg'), 'merek' => 'Platinum', 'deskripsi' => 'Pintu PVC anti-karat...'],
            ['id' => 5, 'name' => 'Kloset Duduk Hemat Air', 'price' => 'Rp 299.000', 'image' => asset('storage/products/kloset.jpg'), 'merek' => 'American Standard', 'deskripsi' => 'Kloset modern dengan teknologi dual flush...'],
            ['id' => 6, 'name' => 'Step Nosing Tangga Anti-Slip', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],
            ['id' => 7, 'name' => 'Produk 1', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],
            ['id' => 8, 'name' => 'Produk 2', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],
            ['id' => 9, 'name' => 'Produk 3', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],
            ['id' => 10, 'name' => 'Produk 4', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],

        ];

        // Ambil 6 produk pertama sebagai produk unggulan
        $featuredProducts = array_slice($allProducts, 0, 8);

        // Jika tidak ada pencarian, tampilkan 6 produk unggulan
        if (!$search) {
            return view('frontend.index', ['products' => $featuredProducts]);
        }

        // --- LOGIKA JIKA ADA PENCARIAN ---

        // 1. Cari dulu di 6 produk unggulan
        $resultsOnHome = collect($featuredProducts)->filter(function ($product) use ($search) {
            return false !== stristr($product['name'], $search);
        });

        // Jika ditemukan di produk unggulan, tampilkan hasilnya di home
        if ($resultsOnHome->isNotEmpty()) {
            return view('frontend.index', ['products' => $resultsOnHome, 'search' => $search]);
        }

        // 2. Jika tidak ada, cari di SEMUA produk
        $resultsOnFullList = collect($allProducts)->filter(function ($product) use ($search) {
            return false !== stristr($product['name'], $search);
        });

        // Jika ditemukan di daftar lengkap, REDIRECT ke halaman produk
        if ($resultsOnFullList->isNotEmpty()) {
            return redirect()->route('produk', ['search' => $search]);
        }

        // 3. Jika tidak ditemukan sama sekali, tampilkan pesan error di home
        return view('frontend.index', [
            'products' => [], // Kirim array kosong
            'search' => $search,
            'searchFailed' => true, // Kirim penanda bahwa pencarian gagal
        ]);
    }

    public function produk(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari URL
        $search = $request->input('search');

        // 2. Ambil semua data produk dari database
        // NOTE: Karena Anda belum menggunakan database, kita akan filter dari data dummy
        $allProducts = [
            ['id' => 1, 'name' => 'Keramik Lantai Motif Kayu', 'price' => 'Rp 249.000', 'image' => asset('storage/products/keramik.jpeg'), 'merek' => 'Granito', 'deskripsi' => 'Keramik lantai berkualitas tinggi...'],
            ['id' => 2, 'name' => 'Wastafel Gantung Minimalis', 'price' => 'Rp 189.000', 'image' => asset('storage/products/wastafel.jpg'), 'merek' => 'Toto', 'deskripsi' => 'Desain hemat tempat...'],
            ['id' => 3, 'name' => 'Shower Mandi Tipe Raindance', 'price' => 'Rp 320.000', 'image' => asset('storage/products/shower.jpg'), 'merek' => 'Wasser', 'deskripsi' => 'Nikmati sensasi mandi hujan...'],
            ['id' => 4, 'name' => 'Pintu Kamar Mandi PVC', 'price' => 'Rp 450.000', 'image' => asset('storage/products/pintu.jpg'), 'merek' => 'Platinum', 'deskripsi' => 'Pintu PVC anti-karat...'],
            ['id' => 5, 'name' => 'Kloset Duduk Hemat Air', 'price' => 'Rp 299.000', 'image' => asset('storage/products/kloset.jpg'), 'merek' => 'American Standard', 'deskripsi' => 'Kloset modern dengan teknologi dual flush...'],
            ['id' => 6, 'name' => 'Step Nosing Tangga Anti-Slip', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],
            ['id' => 7, 'name' => 'Produk 1', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],
            ['id' => 8, 'name' => 'Produk 2', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],
            ['id' => 9, 'name' => 'Produk 3', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],
            ['id' => 10, 'name' => 'Produk 4', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg'), 'merek' => 'Indogress', 'deskripsi' => 'Memberikan keamanan ekstra...'],
        ];

        // 3. Filter data produk JIKA ada input pencarian
        if ($search) {
            // Ubah data array menjadi collection agar bisa difilter dengan mudah
            $products = collect($allProducts)->filter(function ($product) use ($search) {
                // Cari di nama produk, abaikan huruf besar/kecil
                return false !== stristr($product['name'], $search);
            });
        } else {
            // Jika tidak ada pencarian, tampilkan semua produk
            $products = $allProducts;
        }

        // 4. Kirim data yang sudah difilter ke view
        return view('frontend.produk', compact('products'));
    }

    /**
     * Menampilkan halaman Tentang Kami.
     */
    public function tentang()
    {
        return view('frontend.tentang');
    }

    /**
     * Menampilkan halaman Testimoni.
     */
    public function testimoni()
    {
        return view('frontend.testimoni');
    }

    /**
     * Menampilkan halaman Galeri.
     */
    public function galeri()
    {
        return view('frontend.galeri');
    }

    /**
     * Menampilkan halaman Kontak.
     */
    public function kontak()
    {
        return view('frontend.kontak');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Data dummy untuk halaman detail
        $product = [
            'id' => $id,
            'name' => 'Bohemian Vase',
            'price' => 'Rp 249.000',
            'image' => 'https://via.placeholder.com/800x800.png/A3B18A/344E41?text=Vase',
            'description' => 'A beautifully handcrafted bohemian vase that adds a touch of rustic elegance to any room. Made from recycled glass with intricate details, perfect for your favorite flowers or as a standalone decorative piece.',
            'sizes' => ['Small', 'Medium', 'Large'],
            'colors' => ['Sage Green', 'Cream White', 'Terracotta'],
            'stock' => 15
        ];

        return view('frontend.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
