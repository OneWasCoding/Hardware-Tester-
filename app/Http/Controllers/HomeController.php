<?php

namespace App\Http\Controllers;

use App\Models\items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories = DB::table('category')->get();
        $searchMethod = $request->input('search_method', 'like'); // default: like
        $search = $request->input('search');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $categoryId = $request->input('category_id');
    
        switch ($searchMethod) {
            case 'scope':
                $query = items::query()->with('categories');
                if ($search) {
                    $query->search($search); // model scope
                }
                break;
    
            case 'scout':
                $query = items::search($search); // Laravel Scout
                if ($minPrice && $maxPrice) {
                    $query->whereBetween('item_price', [$minPrice, $maxPrice]);
                }
                if ($categoryId) {
                    $query->whereHas('categories', function($q) use ($categoryId) {
                        $q->where('category_id', $categoryId);
                    });
                }
                $items = $query->paginate(9);
                break;
    
            case 'like':
            default:
                $query = DB::table('items');
                if ($search) {
                    $query->where('item_name', 'like', "%$search%");
                }
    
                if ($minPrice && $maxPrice) {
                    $query->whereBetween('item_price', [$minPrice, $maxPrice]);
                }
    
                if ($categoryId) {
                    $query->join('item_category', 'items.item_id', '=', 'item_category.item_id')
                          ->where('item_category.category_id', $categoryId);
                }
    
                $items = $query->select('items.*')->paginate(9);
        }
    
        // Add image and stock data
        foreach ($items as $item) {
            $item->image = DB::table('item_gallery')
                             ->where('item_id', $item->item_id)
                             ->value('img_name');
    
            $stock = DB::table('stocks')
                       ->where('item_id', $item->item_id)
                       ->value('quantity');
            $item->stock_quantity = $stock ?? 0;
        }
    
        return view('home', compact('items', 'categories', 'searchMethod', 'search'));
    }
}
