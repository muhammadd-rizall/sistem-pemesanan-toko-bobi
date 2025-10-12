<?php

namespace Database\Factories;


use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $supplierIds = Supplier::pluck('id')->all();
        $categoryIds = Category::pluck('id')->all();

        return [
            'supplier_id' => $this->faker->randomElement($supplierIds),
            'category_id' => $this->faker->randomElement($categoryIds),
            'nama_produk' => $this->faker->word(),
            'merek' => $this->faker->company(),
            'deskripsi' => $this->faker->sentence(10),
            'harga_beli' => $this->faker->randomFloat(2, 10000, 500000),
            'harga_jual' => $this->faker->randomFloat(2, 50000, 1000000),
            'stok' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['tersedia', 'tidak tersedia']),
            'gambar_produk' => $this->faker->imageUrl(400, 400, 'technics', true),
        ];
    }
}
