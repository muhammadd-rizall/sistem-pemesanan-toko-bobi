<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diskon>
 */
class DiskonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 months');

        return [
            'kode_diskon' => strtoupper($this->faker->unique()->bothify('DISC###')), // Contoh: DISC123
            'nilai_diskon' => $this->faker->randomFloat(2, 5000, 50000), // diskon antara 5.000 – 50.000
            'tanggal_mulai' => $startDate->format('Y-m-d'),
            'tanggal_berakhir' => $endDate->format('Y-m-d'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
