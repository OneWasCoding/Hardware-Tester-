<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Items;
use App\Models\ItemGallery;

class ItemGalleryTableSeeder extends Seeder
{
    public function run(): void
    {
        // Get all the items
        $items = Items::all();

        // Iterate through each item and create galleries
        $items->each(function ($item) {
            ItemGallery::factory()->create([
                'item_id' => $item->item_id,  // Associate gallery with item
                'img_name' => 'image_' . $item->item_id . '.jpg',  // Example image name
            ]);
        });
    }
}
