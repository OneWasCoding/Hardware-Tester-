<?php

namespace App\Imports;

use App\Models\items;
use App\Models\Stocks;
use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            // Access the data by index
            $item = Items::create([
                'item_name' => $row[0],  // Access by index 0 for item_name
                'item_price' => $row[1], // Access by index 1 for item_price
                'item_desc' => $row[2],  // Access by index 2 for item_desc
                'item_status' => $row[3], // Access by index 3 for item_status
            ]);
        
            // Handle category import (create if not exists)
            $category = DB::table('item_category')->insertGetId([
                'item_id' => $item->item_id,
                'category_id'=>1, // Assuming category name is in column 5
            ]);
                
            // Handle stock import
            Stocks::create([
                'item_id' => $item->item_id,
                'quantity' => 25, // Assuming quantity is in column 6
            ]);
        
            return $item;
        }
        

}