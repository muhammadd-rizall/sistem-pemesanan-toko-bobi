<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Produk;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Halaman utama (menampilkan produk terbaru, max 8 item)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query produk dengan relasi kategori
        $query = Produk::with('category')->where('status', 'tersedia');

        // Filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'LIKE', '%' . $search . '%')
                    ->orWhere('merek', 'LIKE', '%' . $search . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        // Ambil maksimal 8 produk terbaru
        $products = $query->orderBy('created_at', 'desc')->take(8)->get();

        return view('frontend.index', [
            'products' => $products,
            'search' => $search,
            'searchFailed' => $search && $products->isEmpty(),
        ]);
    }

    /**
     * Halaman daftar semua produk (dengan filter dan sort)
     */
    public function produk(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');
        $sort = $request->input('sort');

        $query = Produk::with('category')->where('status', 'tersedia');

        // Filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'LIKE', '%' . $search . '%')
                    ->orWhere('merek', 'LIKE', '%' . $search . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        // Filter kategori
        if ($categoryId && $categoryId !== 'all') {
            $query->where('category_id', $categoryId);
        }

        // Urutkan berdasarkan pilihan
        switch ($sort) {
            case 'harga_asc':
                $query->orderBy('harga_jual', 'asc');
                break;
            case 'harga_desc':
                $query->orderBy('harga_jual', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Ambil semua produk (paginate)
        $products = $query->paginate(12)->appends($request->query());

        // Ambil semua kategori untuk dropdown
        $categories = Category::all();

        return view('frontend.produk', [
            'products' => $products,
            'categories' => $categories,
            'search' => $search,
            'categoryId' => $categoryId,
            'sort' => $sort,
        ]);
    }

    /**
     * Halaman detail produk
     */
    public function show($id)
    {


        // 1. Ambil detail produk utama
        $product = Produk::with(['category', 'supplier', 'reviews.customer'])->findOrFail($id);

        // 2. Hitung rating
        $averageRating = $product->reviews->avg('rating') ?? 0;
        $totalReviews = $product->reviews->count();

        // 3. Ambil Rekomendasi (ACAK DARI SEMUA KATEGORI)
        // Syarat: Bukan produk yang sedang dilihat & status tersedia
        $relatedProducts = Produk::where('id', '!=', $id)
            ->where('status', 'tersedia')
            ->inRandomOrder() // Acak urutan
            ->take(7)         // Ambil maksimal 7
            ->get();

        return view('frontend.show', compact('product', 'relatedProducts', 'averageRating', 'totalReviews'));




        // $product = Produk::with('category')->findOrFail($id);

        // return view('frontend.show', compact('product'));
    }


    // Method baru untuk halaman semua review
    public function productReviews(Request $request, $id)
    {

        // 1. Ambil Produk
        $product = Produk::findOrFail($id);

        // 2. Query Dasar Review
        $query = $product->reviews()->with('customer')->latest();

        // 3. Logika Filter (Agar tombol filter berfungsi)
        if ($request->has('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->has('verified')) {
            // Asumsi: Customer terverifikasi jika email_verified_at tidak null
            $query->whereHas('customer', function($q) {
                $q->whereNotNull('email_verified_at');
            });
        }

        // 4. Ambil Data (Pagination)
        $reviews = $query->paginate(8); // Tampilkan 8 review per halaman

        // 5. Statistik Review
        $totalReviews = $product->reviews()->count();
        $averageRating = $product->reviews()->avg('rating') ?? 0;

        // Kirim semua data ke view
        return view('frontend.reviews.index', compact(
            'product',
            'reviews',
            'totalReviews',
            'averageRating'
        ));



        // $product = Produk::with(['reviews.customer'])->findOrFail($id);

        // // Ambil review dengan pagination (misal 10 per halaman)
        // $reviews = $product->reviews()->with('customer')->latest()->paginate(10);

        // $averageRating = $product->reviews->avg('rating') ?? 0;
        // $totalReviews = $product->reviews->count();

        // return view('frontend.reviews.index', compact('product', 'reviews', 'averageRating', 'totalReviews'));
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
}
