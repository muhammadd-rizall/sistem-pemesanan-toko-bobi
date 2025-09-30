<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produks;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function produkView()
    {
        $items = Produks::latest()->paginate(10);
        return view('admin.backend.produk.item_produk', compact('items'));
    }

    public function createProduk()
    {
        return view('admin.backend.produk.create_produk');
    }

    public function storeProduk(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $images = null;
        if ($request->hasFile('gambar_produk')) {
            $images = $request->file('gambar_produk')->store('produks', 'public');
        }

        Produks::create([
            'nama_produk' => $validated['nama_produk'],
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'stok' => $validated['stok'],
            'gambar_produk' => $images,
        ]);

        return redirect()->route('produk_view')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProduk($id)
    {
        $item = Produks::findOrFail($id);
        return view('admin.backend.produk.edit_produk', compact('item'));
    }

    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $item = Produks::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('produks', $filename, 'public');
            $item->gambar_produk = $filename;
        }

        $item->nama_produk = $request->nama_produk;
        $item->deskripsi = $request->deskripsi;
        $item->harga = $request->harga;
        $item->stok = $request->stok;
        $item->save();

        return redirect()->route('produk_view')->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduk($id)
    {
        $item = Produks::findOrFail($id);
        $item->delete();

        return redirect()->route('produk_view')->with('success', 'Produk berhasil dihapus.');
    }
}
