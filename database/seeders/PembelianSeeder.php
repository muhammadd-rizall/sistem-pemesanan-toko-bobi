<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\Produk;

class PembelianSeeder extends Seeder
{
    public function run(): void
    {
        $supplierIds = Supplier::pluck('id')->toArray();
        $produkList = Produk::all();

        if ($supplierIds === [] || $produkList->isEmpty()) {
            $this->command->warn('⚠️ PembelianSeeder dilewati: supplier atau produk kosong');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            $produk = $produkList->random();
            $jumlah = rand(10, 50);

            // 🔑 PASTIKAN HARGA TIDAK NULL
            $harga = $produk->harga_beli ?? rand(5000, 50000);

            Pembelian::create([
                'kode_pembelian' => 'PB-' . now()->format('Ymd') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'tanggal'        => now()->subDays(rand(1, 90)),
                'supplier_id'    => $supplierIds[array_rand($supplierIds)],
                'produk_id'      => $produk->id,
                'jumlah'         => $jumlah,
                'harga_satuan'   => $harga,
                'total'          => $harga * $jumlah, // ❗ WAJIB
                'keterangan'     => $i % 3 === 0 ? 'Pembelian rutin stok' : null,
            ]);
        }

        $this->command->info('✅ PembelianSeeder berhasil dijalankan');
    }
}
