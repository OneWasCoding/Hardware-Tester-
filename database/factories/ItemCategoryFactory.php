<?php

namespace Database\Factories;

use App\Models\ItemCategory;
use App\Models\Items;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemCategoryFactory extends Factory
{
    protected $model = ItemCategory::class;

    public function definition()
    {
        return [
            'item_id' => Items::inRandomOrder()->first()->id,  // Link to a random item
            'category_id' => Category::inRandomOrder()->first()->id,  // Link to a random category
        ];
    }
}
