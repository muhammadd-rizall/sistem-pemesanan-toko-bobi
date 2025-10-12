<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), 
            'phone' => $this->faker->phoneNumber(),
            'provinsi' => $this->faker->state(),
            'kota' => $this->faker->city(),
            'kecamatan' => $this->faker->streetName(),
            'alamat' => $this->faker->address(),
            'kode_pos' => $this->faker->postcode(),
        ];
    }
}
