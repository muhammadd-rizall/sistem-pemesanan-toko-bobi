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
            ->route('pembelian.index')
            ->with('success', 'Pembelian offline berhasil dicatat');
    }

    public function edit(Pembelian $pembelian)
    {
        $produkList = Produk::all();
        $supplierList = Supplier::all();
        return view('admin.pembelian.edit', compact('pembelian', 'produkList', 'supplierList'));
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
            ->route('pembelian.index')
            ->with('success', 'Data pembelian berhasil diperbarui');
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();

        return redirect()
            ->route('pembelian.index')
            ->with('success', 'Data pembelian berhasil dihapus');
    }

    public function export(Request $request)
    {
        $filter = $request->get('filter', 'semua');
        $query = Pembelian::with(['produk', 'supplier']);

        // sama seperti filter di index
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

        // Bisa export CSV misal pake Laravel-Excel, atau sekadar download CSV manual
        $filename = 'pembelian_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($pembelian) {
            $file = fopen('php://output', 'w');
            // Header CSV
            fputcsv($file, ['Kode', 'Tanggal', 'Produk', 'Supplier', 'Jumlah', 'Harga Satuan', 'Total']);
            foreach ($pembelian as $item) {
                fputcsv($file, [
                    $item->kode_pembelian,
                    $item->tanggal->format('d/m/Y'),
                    $item->produk->nama ?? '-',
                    $item->supplier->nama_perusahaan ?? '-',
                    $item->jumlah,
                    $item->harga_satuan,
                    $item->total,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
