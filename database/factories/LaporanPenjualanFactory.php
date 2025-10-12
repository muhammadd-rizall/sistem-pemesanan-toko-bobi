<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaporanPenjualan>
 */
class LaporanPenjualanFactory extends Factory
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

        return [
            'order_id' => $order->id,
            'deskripsi' => $this->faker->optional()->sentence(),
            'pemasukan' => $order->harga_akhir,
            'tanggal_laporan' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
        ];
    }
}
