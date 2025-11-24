<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Produk;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders  = Order::pluck('id')->toArray();
        $produk  = Produk::all();

        if (empty($orders) || $produk->isEmpty()) {
            $this->command->warn("⚠️ Order atau Produk kosong, OrderItemSeeder tidak dijalankan.");
            return;
        }

        foreach ($orders as $orderId) {

            // Buat 1–3 item per order
            $jumlahItem = rand(1, 3);

            for ($i = 0; $i < $jumlahItem; $i++) {

                // Ambil produk random
                $p = $produk[rand(0, $produk->count() - 1)];

                // Quantity random
                $qty = rand(1, 5);

                // Harga satuan diambil dari harga_jual produk
                $hargaSatuan = $p->harga_jual;

                // Hitung total
                $hargaTotal = $hargaSatuan * $qty;

                // Insert
                OrderItem::create([
                    'order_id'     => $orderId,
                    'produk_id'    => $p->id,
                    'quantity'     => $qty,
                    'harga_satuan' => $hargaSatuan,
                    'harga_total'  => $hargaTotal,
                ]);
            }
        }
    }
}
