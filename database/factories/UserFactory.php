<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'age' => $this->faker->numberBetween(18, 60),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'img' => 'default.png',
            'contact' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
