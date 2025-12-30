<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penjualan;
use App\Models\Produk;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $produkList = Produk::all();

        if ($produkList->isEmpty()) {
            $this->command->warn('⚠️ PenjualanSeeder dilewati: produk kosong');
            return;
        }

        $pembeliList = [
            'PT Proyek Pembangunan',
            'CV Kontraktor Jaya',
            'Toko Bangunan Maju',
            'UD Renovasi Rumah',
            null,
        ];

        for ($i = 0; $i < 30; $i++) {
            $produk = $produkList->random();
            $jumlah = rand(1, 15);

            Penjualan::create([
                'tanggal' => now()->subDays(rand(1, 90)),
                'produk_id' => $produk->id,
                'jumlah' => $jumlah,
                'harga_satuan' => $produk->harga_jual,
                'pembeli' => $pembeliList[array_rand($pembeliList)],
                'keterangan' => $i % 4 === 0 ? 'Penjualan cash' : null,
            ]);
        }

        $this->command->info('✅ PenjualanSeeder berhasil dijalankan');
    }
}
