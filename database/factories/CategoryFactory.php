<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_name' => $this->faker->unique()->word(), // Generate a random unique category name
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
