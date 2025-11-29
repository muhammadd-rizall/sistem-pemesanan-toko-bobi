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

        foreach ($orders as $order) {

            $totalOrder = $order->total_harga_akhir;

            // Jenis pembayaran: full atau dp
            $jenisPembayaran = collect(['full', 'dp'])->random();

            if ($jenisPembayaran === 'full') {
                $jumlahTerbayar = $totalOrder;
                $sisaPembayaran = 0;
                $paymentStatus = 'paid';
            } else {
                // DP 30-70%
                $dpPercent = rand(30, 70);
                $jumlahTerbayar = round($totalOrder * ($dpPercent / 100), 2);
                $sisaPembayaran = $totalOrder - $jumlahTerbayar;

                // Status (random tapi valid enum)
                $paymentStatus = $sisaPembayaran == 0
                    ? 'paid'
                    : collect(['unpaid', 'pending'])->random();
            }

            // Metode pembayaran HARUS sesuai migration
            $metodePembayaran = collect(['cod', 'midtrans'])->random();

            // Random bukti (50% ada)
            $buktiPembayaran = rand(1, 100) <= 50
                ? 'bukti_pembayaran/' . uniqid() . '.jpg'
                : null;

            // Tanggal bayar antara 1-30 hari lalu
            $tanggalBayar = now()->subDays(rand(1, 30));

            Payment::create([
                'order_id'           => $order->id,
                'jenis_pembayaran'   => $jenisPembayaran,
                'total_order'        => $totalOrder,
                'jumlah_terbayar'    => $jumlahTerbayar,
                'sisa_pembayaran'    => $sisaPembayaran,
                'metode_pembayaran'  => $metodePembayaran,
                'snap_token'         => 'token_' . uniqid(),
                'snap_redirect_url'  => 'https://example.com/pay/' . uniqid(),
                'bukti_pembayaran'   => $buktiPembayaran,
                'tanggal_bayar'      => $tanggalBayar,
                'pembayaran_status'  => $paymentStatus,
            ]);
        }
    }
}
