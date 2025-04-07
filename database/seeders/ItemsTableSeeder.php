<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Items;

class ItemsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create 20 items (or however many you need)
        Items::factory(20)->create();
    }
}
