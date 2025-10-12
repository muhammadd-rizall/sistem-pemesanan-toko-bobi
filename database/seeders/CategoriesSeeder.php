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
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
