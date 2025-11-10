<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Keramik',
                'description' => 'keramik untuk lantai dan dinding',
                'slug' => 'keramik',
            ],
            [
                'name' => 'Wastafel',
                'description' => 'Home and kitchen appliances',
                'slug' => 'wastafel',
            ],
            [
                'name' => 'Kloset',
                'description' => 'kloset duduk dan jongkok',
                'slug' => 'kloset',
            ],
            [
                'name' => 'Step Nosing Tangga',
                'description' => 'Step nosing untuk tangga',
                'slug' => 'step-nosing-tangga',
            ],
            [
                'name' => 'Pintu Kamar Mandi',
                'description' => 'Pintu untuk kamar mandi',
                'slug' => 'pintu-kamar-mandi',
            ],
            [
                'name' => 'Shower',
                'description' => 'Shower untuk kamar mandi',
                'slug' => 'shower',
            ],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
