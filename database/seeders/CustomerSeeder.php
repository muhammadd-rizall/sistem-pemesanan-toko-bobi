<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'avatar' => 'avatars/user1.jpg',
                'name' => 'Rizal',
                'username' => 'rizal123',
                'email' => 'rizal@example.com',
            ],
            [
                'avatar' => 'avatars/user2.jpg',
                'name' => 'Andi Saputra',
                'username' => 'andi_spt',
                'email' => 'andi@example.com',
            ],
            [
                'avatar' => 'avatars/user3.jpg',
                'name' => 'Budi Santoso',
                'username' => 'budi_san',
                'email' => 'budi@example.com',
            ],
            [
                'avatar' => 'avatars/user4.jpg',
                'name' => 'Dewi Kurnia',
                'username' => 'dewi_krn',
                'email' => 'dewi@example.com',
            ],
            [
                'avatar' => 'avatars/user5.jpg',
                'name' => 'Sinta',
                'username' => 'sinta_01',
                'email' => 'sinta@example.com',
            ],
        ];

        foreach ($customers as $user) {
            Customer::create([
                'avatar' => $user['avatar'],
                'name' => $user['name'],
                'username' => $user['username'],
                'email' => $user['email'],
                'email_verified_at' => rand(0,1) ? now() : null, // random tanpa faker
                'password' => Hash::make('password123'),
                'provider' => null,
                'provider_id' => null,
                'provider_token' => null,
                'provider_refresh_token' => null,
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
