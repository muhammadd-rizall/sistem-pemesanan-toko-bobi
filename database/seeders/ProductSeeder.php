<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Diskon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kategori ada
        if (Category::count() === 0) {
            $this->command->warn("⚠ Tidak ada kategori! Seeder produk tidak dijalankan.");
            return;
        }

        // Supplier random / null
        $supplierIds = Supplier::pluck('id')->toArray();
        $supplierIds[] = null;

        // Diskon random / null
        $diskonIds = Diskon::pluck('id')->toArray();
        $diskonIds[] = null;

        $gambarDefault = 'produks/get_started.jpg';

        $produkList = [
            [
                'nama_produk' => 'Laptop Asus ROG Strix',
                'merek' => 'ASUS',
                'deskripsi' => 'Laptop gaming performa tinggi untuk kebutuhan berat.',
                // 'harga_beli' => 15000000,
                'harga_jual' => 17500000,
                'stok' => 10,
                'status' => 'tersedia',
            ],
            [
                'nama_produk' => 'Mouse Logitech G502',
                'merek' => 'Logitech',
                'deskripsi' => 'Mouse gaming 25.000 DPI dengan fitur RGB.',
                // 'harga_beli' => 700000,
                'harga_jual' => 950000,
                'stok' => 35,
                'status' => 'tersedia',
            ],
            [
                'nama_produk' => 'Keyboard Mechanical Keychron K2',
                'merek' => 'Keychron',
                'deskripsi' => 'Mechanical keyboard compact 75%, hot-swappable.',
                // 'harga_beli' => 1200000,
                'harga_jual' => 1500000,
                'stok' => 20,
                'status' => 'tersedia',
            ],
            [
                'nama_produk' => 'Monitor LG UltraWide 34"',
                'merek' => 'LG',
                'deskripsi' => 'Monitor ultrawide untuk produktivitas tinggi.',
                // 'harga_beli' => 5500000,
                'harga_jual' => 6500000,
                'stok' => 15,
                'status' => 'tersedia',
            ],
            [
                'nama_produk' => 'Harddisk Seagate 2TB',
                'merek' => 'Seagate',
                'deskripsi' => 'HDD 2TB untuk kebutuhan penyimpanan besar.',
                // 'harga_beli' => 600000,
                'harga_jual' => 750000,
                'stok' => 50,
                'status' => 'tersedia',
            ],
        ];

        foreach ($produkList as $p) {
            Produk::create([
                'supplier_id' => collect($supplierIds)->random(),
                'category_id' => Category::inRandomOrder()->first()->id,
                'diskon_id' => collect($diskonIds)->random(),
                'nama_produk' => $p['nama_produk'],
                'merek' => $p['merek'],
                'deskripsi' => $p['deskripsi'],
                // 'harga_beli' => $p['harga_beli'],
                'harga_jual' => $p['harga_jual'],
                'stok' => $p['stok'],
                'status' => $p['status'],
                'gambar_produk' => $gambarDefault,
            ]);
        }
    }
}
