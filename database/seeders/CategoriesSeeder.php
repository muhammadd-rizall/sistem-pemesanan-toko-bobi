<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Keramik',
                'description' => 'keramik untuk lantai dan dinding',
                'slug' => 'keramik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wastafel',
                'description' => 'Home and kitchen appliances',
                'slug' => 'wastafel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kloset',
                'description' => 'kloset duduk dan jongkok',
                'slug' => 'kloset',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
