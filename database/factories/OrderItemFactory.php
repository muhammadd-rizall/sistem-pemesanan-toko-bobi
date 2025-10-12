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
        $produk = Produk::inRandomOrder()->first() ?? Produk::factory()->create();
        $quantity = $this->faker->numberBetween(1, 10);
        $hargaSatuan = $produk->harga_jual; // Menggunakan harga_jual
        $hargaTotal = $hargaSatuan * $quantity;

        return [
            'order_id' => Order::factory(),
            'produk_id' => $produk->id,
            'quantity' => $quantity,
            'harga_satuan' => $hargaSatuan,
            'harga_total' => $hargaTotal,
        ];
    }

    /**
     * Set order tertentu
     */
    public function forOrder(Order $order): static
    {
        return $this->state(fn (array $attributes) => [
            'order_id' => $order->id,
        ]);
    }

    /**
     * Set produk tertentu
     */
    public function forProduk(Produk $produk): static
    {
        return $this->state(fn (array $attributes) => [
            'produk_id' => $produk->id,
            'harga_satuan' => $produk->harga_jual, // Menggunakan harga_jual
            'harga_total' => $produk->harga_jual * $attributes['quantity'],
        ]);
    }
}
