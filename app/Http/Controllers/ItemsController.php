<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\DataTables\ItemsDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
    public function show(items $items)
    {
        //
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
}
