<?php

namespace App\Http\Controllers\Admin;

use App\Models\Diskon;

use App\Models\Produk;
use App\Models\Category;
use App\Models\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{

    //
    //menampilkan data produk dengan pencarian
    //
    public function produkView(Request $request)
    {
        $search = $request->input('search');

        $items = Produk::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10); //search produk


        return view('admin.backend.produk.item_produk', compact('items', 'search',));
    }



    //
    //menampilkan form tambah produk
    //
    public function createProduk()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.backend.produk.create_produk', compact('categories', 'suppliers'));
    }


    //
    // menyimpan data produk
    //
    public function storeProduk(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'merek' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            // 'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $images = null;
        if ($request->hasFile('gambar_produk')) {
            $images = $request->file('gambar_produk')->store('produks', 'public');
        }

        Produk::create([
            'nama_produk' => $validated['nama_produk'],
            'merek' => $validated['merek'],
            'deskripsi' => $validated['deskripsi'],
            'category_id' => $validated['category_id'],
            'supplier_id' => $validated['supplier_id'],
            // 'harga_beli' => $validated['harga_beli'],
            'harga_jual' => $validated['harga_jual'],
            'stok' => $validated['stok'],
            'gambar_produk' => $images,
        ]);

        return redirect()->route('produk_view')->with('success', 'Produk berhasil ditambahkan.');
    }


    //
    // mengedit data produk
    //
    public function editProduk($id)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $item = Produk::findOrFail($id);
        $assignedDiskon = $item->diskon; // Get the currently assigned diskon

        // Get active and upcoming discounts
        $activeDiskons = Diskon::where('tanggal_berakhir', '>=', now())
            ->orWhereNull('tanggal_berakhir') // Include discounts without an end date
            ->get();

        // Combine active discounts with the assigned discount (if not already in active list)
        $diskons = collect();
        if ($assignedDiskon) {
            $diskons->push($assignedDiskon);
        }
        $diskons = $diskons->merge($activeDiskons);
        $diskons = $diskons->unique('id')->sortBy('kode_diskon'); // Ensure uniqueness and sort


        return view('admin.backend.produk.edit_produk', compact('item', 'categories', 'suppliers', 'diskons'));
    }


    //
    // memperbarui data produk
    //
    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'merek' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'diskon_id' =>  'nullable|exists:diskons,id',
            // 'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
            'stok' => 'required|integer|min:0',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $item = Produk::findOrFail($id);

        if ($request->hasFile('gambar_produk')) {

            // hapus gambar lama (opsional tapi disarankan)
            if ($item->gambar_produk && Storage::disk('public')->exists($item->gambar_produk)) {
                Storage::disk('public')->delete($item->gambar_produk);
            }

            $path = $request->file('gambar_produk')->store('produks', 'public');
            $item->gambar_produk = $path; // ✅ SIMPAN DENGAN FOLDER
        }

        $item->nama_produk = $request->nama_produk;
        $item->merek = $request->merek;
        $item->deskripsi = $request->deskripsi;
        $item->category_id = $request->category_id;
        $item->supplier_id = $request->supplier_id;
        $item->diskon_id = $request->diskon_id;
        // $item->harga_beli = $request->harga_jual;
        $item->harga_jual = $request->harga_jual;
        $item->status = $request->status;
        $item->stok = $request->stok;
        $item->save();

        return redirect()->route('produk_view')->with('success', 'Produk berhasil diperbarui.');
    }


    //
    // menghapus data produk
    //
    public function deleteProduk($id)
    {
        $item = Produk::findOrFail($id);
        $item->delete();

        return redirect()->route('produk_view')->with('success', 'Produk berhasil dihapus.');
    }
}
