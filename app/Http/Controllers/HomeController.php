<?php

namespace App\Http\Controllers;

use App\Models\items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch all items
        $items = items::all();
    
        // Fetch the image for each item from the item_gallery table and stock data
        foreach ($items as $item) {
            // Fetch the image for the item
            $item->image = DB::table('item_gallery')
                             ->where('item_id', $item->item_id)
                             ->value('img_name');  // Fetch the img_name for each item
            
            // Fetch the stock quantity for each item
            $stock = DB::table('stocks')
                       ->where('item_id', $item->item_id)
                       ->value('quantity');  // Fetch the quantity from stocks table
            $item->stock_quantity = $stock ? $stock : 0;  // Add stock quantity to the item object
        }
        
        return view('home', compact('items'));
    }
}
