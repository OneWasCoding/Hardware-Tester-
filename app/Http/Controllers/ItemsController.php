<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Imports\ItemImport;
use Illuminate\Http\Request;
use App\DataTables\ItemDataTable;
use App\DataTables\ItemsDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ItemsDataTable $item_dataTable)
    {
        return $item_dataTable->render('admin.item.index');
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $category= DB::table('category')->get();
        return view("admin.item.create",compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            "item_name" => 'min:3',
            "item_price" => "min:5|numeric",
            "item_qty" => "numeric",
            'item_img.*' => 'nullable|image|mimes:jpeg,jpg,png'
        ];
        
        $messages = [
            "item_name.min" => "Product name must be at least 3 characters",
            "item_price.numeric" => "Price must be a number",
            "item_price.min" => "Price must be at least 5",
            'item_img.*.mimes' => 'Only JPG, JPEG or PNG images allowed'
        ];

        $validator = validator($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::transaction(function () use ($request) {
                $item = new items();
                $item->item_name = $request->item_name;
                $item->item_price = $request->item_price;
                $item->item_desc = $request->item_desc;
                $item->item_status = $request->productStatus;

                if ($item->save()) {
                    $last_id = $last_id = DB::getPdo()->lastInsertId();  // Get the last inserted ID manually
                    DB::table('stocks')->insert([
                        'item_id'=>$last_id,
                        'quantity'=>$request->item_qty,
                    ]);

                    DB::table('item_category')->insert([
                        'item_id' => $last_id,
                        'category_id' => $request->item_category
                    ]);

                    if ($request->hasFile('item_img')) {
                        foreach ($request->file('item_img') as $images) {
                            $filename = $images->hashName();
                            $images->storeAs('item_gallery', $filename, 'public');
                            DB::table('item_gallery')->insert([
                                'item_id' => $last_id,
                                'img_name' => $filename
                            ]);
                        }
                           
                    }
                }
            });
        }
    }

    /**
     * Display the specified resource.
     */
    
     public function show($item_id)
     {
         // Get item details
         $item = DB::table('items')
             ->where('items.item_id', $item_id)
             ->first();
     
         if (!$item) {
             return redirect()->route('home')->with('error', 'Item not found');
         }
     
         // Get item images
         $images = DB::table('item_gallery')
             ->where('item_id', $item_id)
             ->get();
     
         // Default image if no images found
         if ($images->isEmpty()) {
             $images = collect([ (object) ['img_name' => 'default.jpg'] ]);
         }
     
         // Get stock quantity
         $stock = DB::table('stocks')
             ->where('item_id', $item_id)
             ->value('quantity') ?? 0;
     
         // Get reviews for this item (filtered by item_id)
         $reviews = DB::table('reviews')
             ->join('users', 'reviews.user_id', '=', 'users.user_id')  // Specify reviews.user_id and users.id explicitly
             ->join('accounts', 'users.account_id', '=', 'accounts.account_id')  // Specify users.account_id and accounts.id explicitly
             ->select('reviews.*', 'accounts.username')  // Select all columns from 'reviews' and 'username' from 'accounts'
             ->where('reviews.item_id',  $item_id)  // Restrict reviews to this item_id
             ->orderBy('reviews.created_at', 'desc')  // Order by 'created_at' in descending order
             ->get();
         
     
         // Calculate average rating
         $avgRating = 0;
         if ($reviews->count() > 0) {
             $avgRating = $reviews->avg('rating');
         }
     
         // Get related products (items from the same categories)
         $categories = DB::table('item_category')
             ->where('item_id', $item_id)
             ->pluck('category_id');
     
         $relatedItems = DB::table('items')
             ->join('item_category', 'items.item_id', '=', 'item_category.item_id')
             ->whereIn('item_category.category_id', $categories)
             ->where('items.item_id', '!=', $item_id)
             ->select('items.*')
             ->distinct()
             ->limit(4)
             ->get();
     
         // Add images to related items
         foreach ($relatedItems as $relatedItem) {
             $relatedItem->image = DB::table('item_gallery')
                 ->where('item_id', $relatedItem->item_id)
                 ->value('img_name');
     
             if (!$relatedItem->image) {
                 $relatedItem->image = 'default.jpg';
             }
         }
     
         return view('customer.item.show', compact('item', 'images', 'stock', 'reviews', 'avgRating', 'relatedItems'));
     }
     
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(items $items,$id)
    {
        $category = DB::table('category')->get();
        $item = items::find($id);
        $item_category = DB::table('item_category')->where('item_id', $id)->first();
        $item_gallery = DB::table('item_gallery')->where('item_id', $id)->get();
        $qty=DB::table('stocks')->where('item_id', $id)->first();
        return view("admin.item.edit", compact('category', 'item', 'item_category', 'item_gallery', 'qty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, items $items)
    {
        // dd($request->all());
        $rules = [
            "item_name" => 'min:3',
            "item_price" => "min:5|numeric",
            "item_qty" => "numeric",
            'item_img.*' => 'nullable|image|mimes:jpeg,jpg,png'
        ];
        
        $messages = [
            "item_name.min" => "Product name must be at least 3 characters",
            "item_price.numeric" => "Price must be a number",
            "item_price.min" => "Price must be at least 5",
            'item_img.*.mimes' => 'Only JPG, JPEG or PNG images allowed'
        ];

        $validator = validator($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::transaction(function () use ($request) {
                $item = items::find($request->item_id);
                $item->item_name = $request->item_name;
                $item->item_price = $request->item_price;
                $item->item_desc = $request->item_desc;
                $item->item_status = $request->status;

                if ($item->save()) {
                    DB::table('stocks')->where('item_id', $request->item_id)->update([
                        'quantity' => $request->stocks,
                    ]);

                    DB::table('item_category')->where('item_id', $request->item_id)->update([
                        'category_id' => $request->category
                    ]);

                    if ($request->hasFile('images')) {
                        foreach ($request->file('images') as $images) {
                            $filename = $images->hashName();
                            $images->storeAs('item_gallery', $filename, 'public');
                            DB::table('item_gallery')->insert([
                                'item_id' => $request->item_id,
                                'img_name' => $filename
                            ]);
                        }
                    }
                }
            });
        }
        return redirect()->route('item.index')->with("success", "Item Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $del=items::find($id);
        if($del->delete($del)){ 
            return redirect()->back()->with("success", "Item Deleted Successfully");
        } else {
            return redirect()->back()->with("error", "Failed to delete item");
        }
    }

    public function restore($id){
        $restore = items::withTrashed()->find($id);
        if ($restore) {
            $restore->restore();
            return redirect()->back()->with("success", "Item Restored Successfully");
        } else {
            return redirect()->back()->with("error", "Failed to restore item");
        }
    }

    public function delete($id){
        $delete = items::withTrashed()->find($id);
        if ($delete) {
            $delete->forceDelete();
            return redirect()->back()->with("success", "Item Deleted Successfully");
        } else {
            return redirect()->back()->with("error", "Failed to delete item");
        }
    }

    public function import(Request $request)
    {

        Excel::import(new ItemImport, $request->file('file')->store('temp'));

        return redirect()->back()->with("success", "Items Imported Successfully");
    }
/*/
    * Store a new review for an item.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $item_id
    * @return \Illuminate\Http\Response
    */
    public function storeReview(Request $request, $item_id)
    {
        // Validate the review input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);
    
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to leave a review');
        }
    
        // Check if the item exists
        $item = DB::table('items')->where('item_id', $item_id)->first();
        if (!$item) {
            return redirect()->route('home')->with('error', 'Item not found');
        }
    
        // Check if the user has a completed order for the item using order_lines
        $hasCompletedOrder = DB::table('orders')
            ->where('orders.account_id', Auth::user()->account_id)  // Assuming account_id is used to identify the user
            ->where('orders.order_status', 'completed')
            ->whereExists(function ($query) use ($item_id) {
                $query->select(DB::raw(1))
                    ->from('order_lines')  // Now using order_lines to link orders and items
                    ->whereColumn('order_lines.order_id', 'orders.order_id')
                    ->where('order_lines.item_id', $item_id);
            })
            ->exists();
    
        if (!$hasCompletedOrder) {
            return redirect()->route('item.show', $item_id)->with('error', 'You must have a completed order for this item to leave a review.');
        }
    
        // Store the review if the user has a completed order
        DB::table('reviews')->insert([
            'item_id' => $item_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('item.show', $item_id)->with('status', 'Review submitted successfully!');
    }
    
}
