<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaporanPembelian>
 */
class LaporanPembelianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $supplierIds = Supplier::pluck('id')->all();
        $supplierId = $this->faker->randomElement($supplierIds);

        // Total pengeluaran acak antara 50.000 hingga 1.000.000
        $pengeluaran = $this->faker->randomFloat(2, 50000, 1000000);

        return [
            'supplier_id' => $supplierId,
            'deskripsi' => $this->faker->optional()->sentence(),
            'pengeluaran' => $pengeluaran,
            'tanggal_laporan' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
        ];
    }
}
