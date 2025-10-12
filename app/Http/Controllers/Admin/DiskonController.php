<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function diskonView(Request $request)
    {

        $search = $request->query('search');

        $datas = Diskon::when($search, function ($query, $search) {
            return $query->where('kode_diskon', 'like', "%{$search}%")
                ->orWhere('nilai_diskon', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10);

        return view('admin.backend.diskon.data', compact('datas', 'search'));
    }

    public function createDiskon()
    {
        return view('admin.backend.diskon.create');
    }

    public function storeDiskon(Request $request)
    {
        $validated = $request->validate([
            'kode_diskon' => 'required|string|max:50|unique:diskons,kode_diskon',
            'nilai_diskon' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',

        ]);

        Diskon::create([
            'kode_diskon' => $validated['kode_diskon'],
            'nilai_diskon' => $validated['nilai_diskon'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_berakhir' => $validated['tanggal_berakhir'],

        ]);

        return redirect()->route('diskonView')->with('success', 'Diskon berhasil ditambahkan.');
    }

    public function editDiskon($id)
    {
        $data = Diskon::findOrFail($id);
        return view('admin.backend.diskon.edit', compact('data'));
    }

    public function updateDiskon(Request $request, $id)
    {
        $data = Diskon::findOrFail($id);

        $validated = $request->validate([
            'kode_diskon' => 'required|string|max:50|unique:diskons,kode_diskon,' . $data->id,
            'nilai_diskon' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:active,inactive',
        ]);


        $validated['nilai_diskon'] = preg_replace('/[^\d.]/', '', $validated['nilai_diskon']);


        $data->update($validated);

        return redirect()->route('diskonView')->with('success', 'Diskon berhasil diperbarui.');
    }

    public function deleteDiskon($id)
    {
        $diskon = Diskon::findOrFail($id);
        $diskon->delete();

        return redirect()->route('diskonView')->with('success', 'Diskon berhasil dihapus.');
    }
}
