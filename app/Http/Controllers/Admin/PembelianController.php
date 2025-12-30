<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'semua');

        $query = Pembelian::with(['produk', 'supplier']);

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

        $pembelian = $query->latest('tanggal')->get();

        // Statistik
        $totalPembelian = $pembelian->sum(fn ($p) => $p->jumlah * $p->harga_satuan);
        $totalTransaksi = $pembelian->count();
        $produkDibeli = $pembelian->sum('jumlah');
        $rataRataTransaksi = $totalTransaksi > 0
            ? $totalPembelian / $totalTransaksi
            : 0;

        // Untuk form tambah pembelian offline
        $produkList = Produk::all();
        $supplierList = Supplier::all();

        return view('admin.pembelian.index', compact(
            'pembelian',
            'totalPembelian',
            'totalTransaksi',
            'produkDibeli',
            'rataRataTransaksi',
            'filter',
            'produkList',
            'supplierList'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        Pembelian::create($validated);

        return redirect()
            ->route('admin.pembelian.index')
            ->with('success', 'Pembelian offline berhasil dicatat');
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $pembelian->update($validated);

        return redirect()
            ->route('admin.pembelian.index')
            ->with('success', 'Data pembelian berhasil diperbarui');
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();

        return redirect()
            ->route('admin.pembelian.index')
            ->with('success', 'Data pembelian berhasil dihapus');
    }
}
