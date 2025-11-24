<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data customer
        $customers = Customer::pluck('id')->toArray();

        if (empty($customers)) {
            $this->command->warn("⚠ Tidak ada customer, OrderSeeder tidak dijalankan.");
            return;
        }

        // DATA ORDER DASAR
        $orders = [
            [
                'alamat_pengiriman' => 'Jl. Melati No. 12, Bandung',
                'catatan' => 'Mohon packing rapi.',
            ],
            [
                'alamat_pengiriman' => 'Jl. Kenanga No. 20, Jakarta Selatan',
                'catatan' => null,
            ],
            [
                'alamat_pengiriman' => 'Jl. Mawar No. 5, Surabaya',
                'catatan' => 'Antar sore jam 5.',
            ],
            [
                'alamat_pengiriman' => 'Jl. Anggrek No. 33, Medan',
                'catatan' => null,
            ],
            [
                'alamat_pengiriman' => 'Jl. Sakura No. 99, Denpasar',
                'catatan' => 'Jangan digantung di pagar.',
            ],
        ];

        foreach ($orders as $item) {

            // TOTAL AWAL RANDOM
            $totalAwal = rand(100000, 5000000);

            // HARGA AKHIR SAMA (tidak ada diskon)
            $hargaAkhir = $totalAwal;

            // CUSTOMER RANDOM
            $customerId = $customers[array_rand($customers)];

            // NO HP RANDOM
            $nohp = '08' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);

            // STATUS RANDOM
            $statusList = ['pending', 'proses', 'dikirim', 'cancelled'];
            $pembayaranList = ['pending', 'lunas', 'belum_lunas'];

            Order::create([
                'customer_id'       => $customerId,
                'invoice_number'    => 'INV-' . Str::upper(Str::random(8)),

                'total_harga_awal'  => $totalAwal,
                'total_diskon'      => 0,
                'total_harga_akhir' => $hargaAkhir,

                'no_hp'             => $nohp,
                'alamat_pengiriman' => $item['alamat_pengiriman'],
                'catatan'           => $item['catatan'],

                'status'            => $statusList[array_rand($statusList)],
                'pembayaran_status' => $pembayaranList[array_rand($pembayaranList)],
            ]);
        }
    }
}
