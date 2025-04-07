<?php

namespace Database\Factories;

use App\Models\ItemGallery;
use App\Models\Items;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemGalleryFactory extends Factory
{
    protected $model = ItemGallery::class;

    public function definition()
    {
        return [
            'item_id' => Items::inRandomOrder()->first()->id,  // Link to a random item
            'img_name' => $this->faker->imageUrl(640, 480, 'technics', true),  // Fake image URL
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
