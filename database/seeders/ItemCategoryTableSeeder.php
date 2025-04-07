<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Items;
use App\Models\Category;

class ItemCategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        // Get all the items
        $items = Items::all();

        // Iterate through each item and assign random categories
        $items->each(function ($item) {
            // Attach random categories to each item
            $item->categories()->attach(
                Category::inRandomOrder()->take(2)->pluck('category_id')->toArray()
            );
        });
    }
}
