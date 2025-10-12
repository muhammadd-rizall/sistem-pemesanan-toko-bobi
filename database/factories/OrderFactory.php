<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Diskon;
use App\Models\Order;
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
    protected $model = Order::class;

    public function definition(): array
    {
        $customerIds = Customer::pluck('id')->all();
        $diskonIds = Diskon::pluck('id')->all();

        return [
            'customer_id' => $this->faker->randomElement($customerIds),
            'diskon_id' => $this->faker->optional()->randomElement($diskonIds),
            'total_harga_awal' => 0,   // akan dihitung di seeder
            'total_diskon' => 0,       // akan dihitung di seeder
            'total_harga_akhir' => 0,  // akan dihitung di seeder
            'alamat_pengiriman' => $this->faker->address(),
            'catatan' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['pending', 'proses', 'dikirim', 'cancelled']),
            'pembayaran_status' => $this->faker->randomElement(['pending', 'lunas', 'belum_lunas']),
        ];
    }
}
