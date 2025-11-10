<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

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
        $query = Produk::with('category')->where('status', 'tersedia');

        // 3. Jika ada pencarian, filter berdasarkan nama produk, merek, atau deskripsi
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'LIKE', '%' . $search . '%')
                    ->orWhere('merek', 'LIKE', '%' . $search . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        // 4. Ambil produk (maksimal 8 untuk homepage)
        $products = $query->take(8)->orderBy('created_at', 'desc')->get(); // Tambah orderBy

        // // 4. Ambil produk (maksimal 8 untuk homepage)
        // $products = $query->take(8)->get();

        // 5. Kirim data ke view
        return view('frontend.index', [
            'products' => $products,
            'search' => $search,
            'searchFailed' => $search && $products->isEmpty()
        ]);
    }

    public function produk(Request $request)
    {
        // // 1. Ambil kata kunci pencarian dari URL
        // $search = $request->input('search');

        // 1. Ambil kata kunci pencarian & filter dari URL
        $search = $request->input('search');
        $categoryId = $request->input('category'); // <-- TAMBAHKAN INI
        $sort = $request->input('sort'); // <-- TAMBAHKAN INI

        // // 2. Query semua produk yang tersedia
        // $query = Produk::where('status', 'tersedia');

        // 2. Query semua produk yang tersedia
        // UBAH BARIS INI: Tambahkan with('category')
        $query = Produk::with('category')->where('status', 'tersedia');

        // 3. Filter jika ada pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'LIKE', '%' . $search . '%')
                    ->orWhere('merek', 'LIKE', '%' . $search . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        // TAMBAHKAN INI: Filter berdasarkan Kategori
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // TAMBAHKAN INI: Filter berdasarkan Urutan (Sort)
        if ($sort == 'harga_asc') {
            $query->orderBy('harga_jual', 'asc');
        } elseif ($sort == 'harga_desc') {
            $query->orderBy('harga_jual', 'desc');
        } else {
            // Default sort (terbaru)
            $query->orderBy('created_at', 'desc');
        }

        // // 4. Ambil semua produk yang sesuai dengan pagination (opsional)
        // $products = $query->paginate(12); // atau ->get() jika tidak perlu pagination

        // 4. Ambil semua produk yang sesuai dengan pagination
        // UBAH BARIS INI: Tambahkan appends() agar filter tetap ada saat ganti halaman
        $products = $query->paginate(12)->appends($request->query());

        // 5. Flag untuk pencarian gagal
        $searchFailed = $search && $products->isEmpty();

        // 6. TAMBAHKAN INI: Ambil semua kategori untuk dropdown filter
        $categories = Category::orderBy('name', 'asc')->get();

        // 6. Kirim data ke view
        return view('frontend.produk', compact('products', 'search', 'searchFailed'));

        // 7. Kirim data ke view
        // UBAH BARIS INI: Tambahkan 'categories'
        return view('frontend.produk', compact('products', 'search', 'searchFailed', 'categories'));
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
