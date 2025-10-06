<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
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

    public function createSupplier()
    {
        return view('admin.backend.supplier.create');
    }

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

    public function editSupplier($id)
    {
        $data = Supplier::findOrFail($id);
        return view('admin.backend.supplier.edit', compact('data'));
    }

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
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validated);

        return redirect()->route('supplierView')->with('success', 'Supplier berhasil diupdate.');
    }

    public function deleteSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplierView')->with('success', 'Supplier berhasil dihapus.');
    }
}
