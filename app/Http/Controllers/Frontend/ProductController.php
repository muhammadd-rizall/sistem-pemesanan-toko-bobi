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
    public function index()
    {
        // Ambil 6 produk terbaru untuk ditampilkan di halaman utama
        $products = [
            ['id' => 1, 'name' => 'Keramik Lantai', 'price' => 'Rp 249.000', 'image' => asset('storage/products/keramik.jpeg')],
            ['id' => 2, 'name' => 'Wastafel', 'price' => 'Rp 189.000', 'image' => asset('storage/products/wastafel.jpg')],
            ['id' => 3, 'name' => 'Shower Mandi', 'price' => 'Rp 320.000', 'image' => asset('storage/products/shower.jpg')],
            ['id' => 4, 'name' => 'Pintu Kamar Mandi', 'price' => 'Rp 450.000', 'image' => asset('storage/products/pintu.jpg')],
            ['id' => 5, 'name' => 'Kloset Duduk', 'price' => 'Rp 299.000', 'image' => asset('storage/products/kloset.jpg')],
            ['id' => 6, 'name' => 'Step Nosing Tangga', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg')],
        ]; // Ini masih data dummy, kita batasi manual

        // Jika Anda sudah menggunakan database, kodenya akan seperti ini:
        // $products = \App\Models\Produk::latest()->take(6)->get();

        return view('frontend.index', compact('products'));
    }

    public function produk(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari URL
        $search = $request->input('search');

        // 2. Ambil semua data produk dari database
        // NOTE: Karena Anda belum menggunakan database, kita akan filter dari data dummy
        $allProducts = [
            ['id' => 1, 'name' => 'Keramik Lantai', 'price' => 'Rp 249.000', 'image' => asset('storage/products/keramik.jpeg')],
            ['id' => 2, 'name' => 'Wastafel Dinding', 'price' => 'Rp 189.000', 'image' => asset('storage/products/wastafel.jpg')],
            ['id' => 3, 'name' => 'Shower Mandi Set', 'price' => 'Rp 320.000', 'image' => asset('storage/products/shower.jpg')],
            ['id' => 4, 'name' => 'Pintu Kamar Mandi PVC', 'price' => 'Rp 450.000', 'image' => asset('storage/products/pintu.jpg')],
            ['id' => 5, 'name' => 'Kloset Duduk Modern', 'price' => 'Rp 299.000', 'image' => asset('storage/products/kloset.jpg')],
            ['id' => 6, 'name' => 'Step Nosing Tangga Kayu', 'price' => 'Rp 150.000', 'image' => asset('storage/products/stepnosing.jpg')],
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
