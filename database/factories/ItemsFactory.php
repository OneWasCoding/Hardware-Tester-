<?php

namespace Database\Factories;

use App\Models\Items;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemsFactory extends Factory
{
    protected $model = Items::class;

    public function definition()
    {
        return [
            'item_name' => $this->faker->unique()->word,  // Generates a fake word for item_name
            'item_price' => $this->faker->randomFloat(2, 1, 100),  // Generates a random price
            'item_desc' => $this->faker->sentence,  // Generates a fake sentence for description
            'item_status' => $this->faker->randomElement(['available', 'out_of_stock']),  // Random status
        ];
    }
}
