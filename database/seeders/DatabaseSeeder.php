<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Diskon;
use App\Models\LaporanPembelian;
use App\Models\LaporanPenjualan;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Produk;
use App\Models\Review;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CategoriesSeeder::class,
        ]);


        // 2. Seed suppliers (20 data)
        Supplier::factory(20)->create();

        // 3. Seed products (20 data)
        Produk::factory(20)->create();

        // 4. Seed customers (20 data)
        Customer::factory(20)->create();

        // 5. Seed diskons (20 data)
        Diskon::factory(20)->create();

        // 6. Seed orders (20 data)
        Order::factory(20)->create()->each(function ($order) {
            // 7. Seed order_items (2–5 items per order)
            $jumlahItems = rand(2, 5);
            for ($i = 0; $i < $jumlahItems; $i++) {
                OrderItem::factory()->create([
                    'order_id' => $order->id
                ]);
            }

            // 8. Seed payment per order
            Payment::factory()->create([
                'order_id' => $order->id
            ]);

            // 9. Seed laporan_penjualans per order
            LaporanPenjualan::factory()->create([
                'order_id' => $order->id
            ]);
        });

        // 10. Seed laporan_pembelians (1 per supplier)
        Supplier::all()->each(function ($supplier) {
            LaporanPembelian::factory()->create([
                'supplier_id' => $supplier->id
            ]);
        });

        // 11. Seed reviews (1–3 per product)
        Produk::all()->each(function ($produk) {
            $jumlahReview = rand(1, 3);
            for ($i = 0; $i < $jumlahReview; $i++) {
                Review::factory()->create([
                    'produk_id' => $produk->id
                ]);
            }
        });
    }
}
