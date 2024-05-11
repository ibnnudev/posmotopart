<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Ban Motor',
            'Oli Motor',
            'Oli Transmisi Dan Oli Samping',
            'Bodyparts Motor',
            'Aki Motor',
        ];

        ProductCategory::insert(array_map(function ($category) {
            return ['name' => $category];
        }, $categories));
    }
}
