<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'semua');

        $query = Penjualan::with('produk');

        switch ($filter) {
            case 'hari_ini':
                $query->whereDate('tanggal', today());
                break;

            case 'minggu_ini':
                $query->whereBetween('tanggal', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
                break;

            case 'bulan_ini':
                $query->whereMonth('tanggal', now()->month)
                      ->whereYear('tanggal', now()->year);
                break;

            case 'tahun_ini':
                $query->whereYear('tanggal', now()->year);
                break;
        }

        $penjualan = $query->latest('tanggal')->get();

        // Statistik
        $totalPenjualan   = $penjualan->sum('total');
        $totalTransaksi   = $penjualan->count();
        $produkTerjual    = $penjualan->sum('jumlah');
        $rataRataTransaksi = $totalTransaksi > 0
            ? $totalPenjualan / $totalTransaksi
            : 0;

        $produkList = Produk::all();

        return view('admin.penjualan.index', compact(
            'penjualan',
            'totalPenjualan',
            'totalTransaksi',
            'produkTerjual',
            'rataRataTransaksi',
            'filter',
            'produkList'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal'       => 'required|date',
            'produk_id'     => 'required|exists:produk,id',
            'jumlah'        => 'required|integer|min:1',
            'harga_satuan'  => 'required|numeric|min:0',
            'pembeli'       => 'nullable|string|max:255',
            'keterangan'    => 'nullable|string',
        ]);

        $data['total'] = $data['jumlah'] * $data['harga_satuan'];

        Penjualan::create($data);

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil ditambahkan');
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $data = $request->validate([
            'tanggal'       => 'required|date',
            'produk_id'     => 'required|exists:produk,id',
            'jumlah'        => 'required|integer|min:1',
            'harga_satuan'  => 'required|numeric|min:0',
            'pembeli'       => 'nullable|string|max:255',
            'keterangan'    => 'nullable|string',
        ]);

        $data['total'] = $data['jumlah'] * $data['harga_satuan'];

        $penjualan->update($data);

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil diperbarui');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil dihapus');
    }
}
