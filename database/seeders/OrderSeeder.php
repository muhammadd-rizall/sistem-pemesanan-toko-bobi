<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;
use App\Models\Diskon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(20)->create()->each(function ($order) {
            $totalHargaAwal = 0;

            // Buat 1–5 order items per order
            $jumlahItems = rand(1, 5);
            for ($i = 0; $i < $jumlahItems; $i++) {
                $produk = Produk::inRandomOrder()->first();
                $quantity = rand(1, 5);
                $hargaSatuan = $produk->harga_jual;
                $totalItem = $quantity * $hargaSatuan;

                $totalHargaAwal += $totalItem;

                OrderItem::create([
                    'order_id' => $order->id,
                    'produk_id' => $produk->id,
                    'quantity' => $quantity,
                    'harga_satuan' => $hargaSatuan,
                    'harga_total' => $totalItem,
                ]);
            }

            // Hitung diskon jika ada
            $diskon = $order->diskon_id ? Diskon::find($order->diskon_id) : null;
            $totalDiskon = $diskon ? min($diskon->nilai_diskon, $totalHargaAwal) : 0;

            // Update order dengan harga yang benar
            $order->update([
                'total_harga_awal' => $totalHargaAwal,
                'total_diskon' => $totalDiskon,
                'total_harga_akhir' => $totalHargaAwal - $totalDiskon,
            ]);
        });
    }
}
