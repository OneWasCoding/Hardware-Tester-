<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_name' => $this->faker->randomElement(['keyboard', 'keycaps', 'switches']), // Generate one of the predefined values
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
