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
        $totalHarga = $this->faker->randomFloat(2, 50000, 5000000);

        // 50% kemungkinan ada diskon
        $diskonId = $this->faker->boolean(50) ? Diskon::inRandomOrder()->first()?->id : null;

        $totalDiskon = 0;
        if ($diskonId) {
            $diskon = Diskon::find($diskonId);
            if ($diskon) {
                if ($diskon->jenis_diskon === 'persentase') {
                    $totalDiskon = ($totalHarga * $diskon->nilai_diskon) / 100;
                } else {
                    $totalDiskon = $diskon->nilai_diskon;
                }
            }
        }

        $hargaAkhir = $totalHarga - $totalDiskon;

        return [
            'customer_id' => Customer::inRandomOrder()->first()?->id ?? Customer::factory(),
            'diskon_id' => $diskonId,
            'total_harga' => $totalHarga,
            'total_diskon' => $totalDiskon,
            'harga_akhir' => $hargaAkhir,
            'alamat_pengiriman' => $this->faker->address(),
            'catatan' => $this->faker->boolean(30) ? $this->faker->sentence() : null,
            'status' => $this->faker->randomElement(['pending', 'proses', 'dikirim', 'cancelled']),
            'pembayaran_status' => $this->faker->randomElement(['pending', 'lunas', 'belum_lunas']),
        ];
    }

    /**
     * Order dengan status pending
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'pembayaran_status' => 'pending',
        ]);
    }

    /**
     * Order dengan status lunas
     */
    public function lunas(): static
    {
        return $this->state(fn (array $attributes) => [
            'pembayaran_status' => 'lunas',
        ]);
    }

    /**
     * Order tanpa diskon
     */
    public function withoutDiskon(): static
    {
        return $this->state(fn (array $attributes) => [
            'diskon_id' => null,
            'total_diskon' => 0,
            'harga_akhir' => $attributes['total_harga'],
        ]);
    }
}
