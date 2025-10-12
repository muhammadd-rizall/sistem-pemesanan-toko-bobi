<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Diskon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $customerIds = Customer::pluck('id')->all();
        $diskonIds = Diskon::pluck('id')->all();

        $totalHarga = $this->faker->randomFloat(2, 50000, 1000000);

        // Tentukan apakah ada diskon atau tidak
        $diskonId = $this->faker->optional()->randomElement($diskonIds);
        $totalDiskon = $diskonId ? $this->faker->randomFloat(2, 5000, min(50000, $totalHarga)) : 0;

        return [
            'customer_id' => $this->faker->randomElement($customerIds),
            'diskon_id' => $diskonId,
            'total_harga' => $totalHarga,
            'total_diskon' => $totalDiskon,
            'harga_akhir' => $totalHarga - $totalDiskon,
            'alamat_pengiriman' => $this->faker->address(),
            'catatan' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['pending', 'proses', 'dikirim', 'cancelled']),
            'pembayaran_status' => $this->faker->randomElement(['pending', 'lunas', 'belum_lunas']),
        ];
    }
}
