<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Produk;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderIds = Order::pluck('id')->all();
        $produkIds = Produk::pluck('id')->all();

        $produk = Produk::find($this->faker->randomElement($produkIds));
        $quantity = $this->faker->numberBetween(1, 5);

        return [
            'order_id' => $this->faker->randomElement($orderIds),
            'produk_id' => $produk->id,
            'quantity' => $quantity,
            'harga_satuan' => $produk->harga_jual,
            'harga_total' => $produk->harga_jual * $quantity,
        ];
    }
}
