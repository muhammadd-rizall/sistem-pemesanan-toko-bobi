<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    //
    //menampilkan data supplier dengan pencarian
    //
    public function supplierView(Request $request)
    {
        $search = $request->input('search');

        $datas = Supplier::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_perusahaan', 'like', "%{$search}%")
                    ->orWhere('kontak_person', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.backend.supplier.data', compact('datas', 'search'));
    }


    //
    //menampilkan form tambah supplier
    //
    public function createSupplier()
    {
        return view('admin.backend.supplier.create');
    }


    //
    // menyimpan data supplier
    //
    public function storeSupplier(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'kontak_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:suppliers,email',
            'provinsi' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'alamat' => 'required|string',
        ]);

        Supplier::create($validated);

        return redirect()->route('supplierView')->with('success', 'Supplier berhasil ditambahkan.');
    }


    //
    // mengedit data supplier
    //
    public function editSupplier($id)
    {
        $data = Supplier::findOrFail($id);
        return view('admin.backend.supplier.edit', compact('data'));
    }


    //
    // memperbarui data supplier
    //
    public function updateSupplier(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'kontak_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:suppliers,email,' . $id,
            'provinsi' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validated);

        return redirect()->route('supplierView')->with('success', 'Supplier berhasil diupdate.');
    }


    //
    // menghapus data supplier
    //
    public function deleteSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplierView')->with('success', 'Supplier berhasil dihapus.');
    }
}
