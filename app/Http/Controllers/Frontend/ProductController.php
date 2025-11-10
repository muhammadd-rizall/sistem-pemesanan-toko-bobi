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

        // 2. Query produk yang tersedia dengan eager loading
        $query = Produk::where('status', 'tersedia');

        // 3. Jika ada pencarian, filter berdasarkan nama produk, merek, atau deskripsi
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'LIKE', '%' . $search . '%')
                    ->orWhere('merek', 'LIKE', '%' . $search . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        // 4. Ambil produk (maksimal 8 untuk homepage)
        $products = $query->take(8)->get();

        // 5. Kirim data ke view
        return view('frontend.index', [
            'products' => $products,
            'search' => $search,
            'searchFailed' => $search && $products->isEmpty()
        ]);
    }

    public function produk(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari URL
        $search = $request->input('search');

        // 2. Query semua produk yang tersedia
        $query = Produk::where('status', 'tersedia');

        // 3. Filter jika ada pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'LIKE', '%' . $search . '%')
                    ->orWhere('merek', 'LIKE', '%' . $search . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        // 4. Ambil semua produk yang sesuai dengan pagination (opsional)
        $products = $query->paginate(12); // atau ->get() jika tidak perlu pagination

        // 5. Flag untuk pencarian gagal
        $searchFailed = $search && $products->isEmpty();

        // 6. Kirim data ke view
        return view('frontend.produk', compact('products', 'search', 'searchFailed'));
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data produk dari database dengan relasi
        $product = Produk::with(['category', 'supplier'])->findOrFail($id);

        return view('frontend.show', compact('product'));
    }
}
