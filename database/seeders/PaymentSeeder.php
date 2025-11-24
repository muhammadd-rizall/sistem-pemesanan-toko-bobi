<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();

        if ($orders->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada data orders, PaymentSeeder tidak dijalankan.');
            return;
        }

        $metodePembayaran = ['transfer bank', 'cash', 'midtrans', 'qris'];

        foreach ($orders as $order) {
            $totalOrder = $order->total_harga_akhir;

            // Random jenis pembayaran manual
            $jenisList = ['full', 'dp'];
            $jenisPembayaran = $jenisList[array_rand($jenisList)];

            $jumlahTerbayar = 0;
            $sisaPembayaran = 0;
            $status = 'pending';

            if ($jenisPembayaran === 'full') {
                // Full payment
                $jumlahTerbayar = $totalOrder;
                $sisaPembayaran = 0;
                $status = 'completed';

            } else {
                // DP: 30-70%
                $persenDp = rand(30, 70);
                $jumlahTerbayar = round($totalOrder * ($persenDp / 100), 2);
                $sisaPembayaran = $totalOrder - $jumlahTerbayar;

                // Status pembayaran
                if ($sisaPembayaran <= 0) {
                    $status = 'completed';
                } else {
                    $statusList = ['pending', 'completed'];
                    $status = $statusList[array_rand($statusList)];
                }
            }

            // Random bukti pembayaran 60% ada, 40% null
            $buktiPembayaran = rand(1, 100) <= 60
                ? 'bukti_pembayaran/' . uniqid() . '.jpg'
                : null;

            // Random tanggal bayar manual (1–30 hari lalu)
            $hariLalu = rand(1, 30);
            $tanggalBayar = now()->subDays($hariLalu);

            Payment::create([
                'order_id'          => $order->id,
                'jenis_pembayaran'  => $jenisPembayaran,
                'total_order'       => $totalOrder,
                'jumlah_terbayar'   => $jumlahTerbayar,
                'sisa_pembayaran'   => $sisaPembayaran,
                'metode_pembayaran' => $metodePembayaran[array_rand($metodePembayaran)],
                'bukti_pembayaran'  => $buktiPembayaran,
                'tanggal_bayar'     => $tanggalBayar,
                'status'            => $status,
            ]);
        }
    }
}
