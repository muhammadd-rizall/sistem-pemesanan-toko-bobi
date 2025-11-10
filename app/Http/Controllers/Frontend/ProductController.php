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
        $product = Produk::with('category')->findOrFail($id);

        return view('frontend.show', compact('product'));
    }
}
