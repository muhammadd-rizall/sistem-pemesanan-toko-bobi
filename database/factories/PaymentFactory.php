<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderIds = Order::pluck('id')->all();
        $order = Order::find($this->faker->randomElement($orderIds));

        // Tentukan jenis pembayaran
        $jenisPembayaran = $this->faker->randomElement(['full', 'dp']);

        $jumlahTerbayar = $jenisPembayaran === 'full'
            ? $order->harga_akhir
            : $this->faker->randomFloat(2, 10000, $order->harga_akhir - 1000);

        return [
            'order_id' => $order->id,
            'jenis_pembayaran' => $jenisPembayaran,
            'total_order' => $order->harga_akhir,
            'jumlah_terbayar' => $jumlahTerbayar,
            'sisa_pembayaran' => max($order->harga_akhir - $jumlahTerbayar, 0),
            'metode_pembayaran' => $this->faker->randomElement(['credit_card', 'bank_transfer', 'e_wallet', 'cash_on_delivery', 'qris']),
            'bukti_pembayaran' => $this->faker->optional()->imageUrl(400, 400, 'finance', true),
            'tanggal_bayar' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
        ];
    }
}
