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
    public function index(Request $request)
    {
        $categories = DB::table('category')->get();
    
        // Base query
        $query = DB::table('items')
            ->select('items.*')
            ->leftJoin('item_category', 'items.item_id', '=', 'item_category.item_id');
    
        // Apply filters
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('item_price', [
                $request->input('min_price'),
                $request->input('max_price'),
            ]);
        }
    
        if ($request->filled('category_id')) {
            $query->where('item_category.category_id', $request->input('category_id'));
        }
    
        $query->distinct(); // Avoid duplicate rows due to joins
    
        $items = $query->get();
    
        // Attach image and stock info
        foreach ($items as $item) {
            $item->image = DB::table('item_gallery')
                            ->where('item_id', $item->item_id)
                            ->value('img_name');
    
            $item->stock_quantity = DB::table('stocks')
                                ->where('item_id', $item->item_id)
                                ->value('quantity') ?? 0;
        }
    
        return view('home', compact('items', 'categories'));
    }
    
}
