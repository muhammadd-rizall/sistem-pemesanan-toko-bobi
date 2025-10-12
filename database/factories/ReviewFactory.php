<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $produkIds = Produk::pluck('id')->all();
        $customerIds = Customer::pluck('id')->all();

        return [
            'produk_id' => $this->faker->randomElement($produkIds),
            'customer_id' => $this->faker->randomElement($customerIds),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->optional()->sentence(10),
        ];
    }
}
