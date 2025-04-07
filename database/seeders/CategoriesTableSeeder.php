<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 fake categories
        Category::factory(20)->create();
    }
}
