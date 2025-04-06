<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\orders;
use App\Models\order_lines;
use App\Models\items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::id();  // Get the logged-in user's ID
            // Fetch cart items for the user along with item details, images, and stock information
            $cartItems = DB::table('cart')
                        ->join('items', 'cart.item_id', '=', 'items.item_id')
                        ->leftJoin('item_gallery', 'cart.item_id', '=', 'item_gallery.item_id')
                        ->join('stocks', 'items.item_id', '=', 'stocks.item_id')
                        ->where('cart.user_id', $userId)
                        ->select(
                            'cart.cart_id',
                            'cart.item_id',
                            'items.item_name',
                            'items.item_desc',
                            'items.item_price',
                            DB::raw('GROUP_CONCAT(DISTINCT item_gallery.img_name) AS img_name'),
                            'stocks.quantity as stock_quantity',
                            'cart.quantity as quantity',
                        )
                        ->groupBy(
                            'cart.quantity',
                            'cart.cart_id',
                            'cart.item_id',
                            'items.item_name',
                            'items.item_desc',
                            'items.item_price',
                            'stocks.quantity'
                        )
                        ->get();
                    // dd($cartItems);
            return view('customer.cart.index', compact('cartItems'));
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to view your cart.');
        }
    }
    public function showItem($itemId)
{
    $item = items::findOrFail($itemId);
    return view('customer.item', compact('item'));
}
public function addToCart(Request $request, $itemId)
{
    if (Auth::check()) {
        $userId = Auth::id();  // Get the logged-in user's ID

        // Check if the item is already in the cart for the current user
        $cartItem = DB::table('cart')
            ->where('user_id', $userId)
            ->where('item_id', $itemId)
            ->first();

        // If the item is already in the cart, update the quantity
        if ($cartItem) {
            $total_qty=$cartItem->quantity + $request->quantity;
            // dd($total_qty);
            DB::table('cart')
                ->where('cart_id', $cartItem->cart_id)
                ->update(['quantity' => $total_qty]); // Increment the quantity
        } else {
            // If the item is not in the cart, add it
            DB::table('cart')->insert([
                'user_id' => $userId,
                'item_id' => $itemId,
                'quantity' => $request->quantity,  // Initial quantity
                'created_at' => now(),  // Set the created_at timestamp
                'updated_at' => now(),  // Set the updated_at timestamp
            ]);
        }

        return redirect()->route('cart.index');  // Redirect to the cart page
    } else {
        return redirect()->route('login')->with('error', 'You must be logged in to add items to your cart.');
    }
}
public function delete($cartId)
{
    // Ensure the user is logged in
    if (Auth::check()) {
        $userId = Auth::id();
        
        // Delete the cart item
        DB::table('cart')
            ->where('cart_id', $cartId)
            ->where('user_id', $userId)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    return redirect()->route('login')->with('error', 'You must be logged in to remove items from the cart.');
}
public function update(Request $request)
{
    // Ensure the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Get the user's cart
    $cartItems = Cart::where('user_id', Auth::id())->get();

    // Loop through each cart item to update the quantity
    foreach ($cartItems as $cartItem) {
        // Check if the quantity for the current cart item exists in the request
        if (isset($request->quantity[$cartItem->cart_id])) {
            // Update the quantity
            $cartItem->quantity = $request->quantity[$cartItem->cart_id];
            
            // Explicitly use cart_id as the primary key for the update
            Cart::where('cart_id', $cartItem->cart_id)->update([
                'quantity' => $request->quantity[$cartItem->cart_id]
            ]);
        }
    }

    // Redirect back to the cart page with a success message
    return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
}



    // public function clearCart()
    // {
    //     $userId = auth()->id();
    //     Cart::where('user_id', $userId)->delete();

    //     return redirect()->back()->with('success', 'Cart cleared successfully!');
    // }
    // public function checkout()
    // {
    //     // Implement your checkout logic here
    //     // For example, redirect to a payment page or process the order

    //     return redirect()->back()->with('success', 'Checkout successful!');
    // }
    // public function viewCart()
    // {
    //     $userId = auth()->id();
    //     $cartItems = Cart::with('item')->where('user_id', $userId)->get();

    //     return view('cart.view', compact('cartItems'));
    // }

    // public function removeFromCart($cartId)
    // {
    //     $cartItem = Cart::findOrFail($cartId);
    //     $cartItem->delete();

    //     return redirect()->back()->with('success', 'Item removed from cart!');


    
    public function checkout(Request $request, Cart $cart)
    {
        // dd(Auth::id());
     $cart=DB::table('cart')
            ->join('users', 'cart.user_id', '=', 'users.user_id')
     ->join('accounts', 'users.account_id', '=', 'accounts.account_id')
            ->join('items', 'cart.item_id', '=', 'items.item_id')
            ->leftJoin('item_gallery', 'cart.item_id', '=', 'item_gallery.item_id')
            ->join('stocks', 'items.item_id', '=', 'stocks.item_id')
            ->where('cart.user_id', Auth::id())
            ->select(
                'accounts.account_id',
                'cart.cart_id',
                'cart.item_id',
                'items.item_name',
                'items.item_desc',
                'items.item_price',
                'cart.quantity as quantity',
            )
            ->groupBy(
                'accounts.account_id',
                'cart.quantity',
                'cart.cart_id',
                'cart.item_id',
                'items.item_name',
                'items.item_desc',
                'items.item_price',
                'stocks.quantity'
            )->get();
            // dd($cart);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->item_price * $item->quantity;
        }
        
        $order= new orders();
        $order->account_id=$cart[0]->account_id; 
        $order->total_amount=$total;
        $order->order_status='pending';
        $order->shipping_address='sa bahay nyo';
        $order->save();
        $order_id=$order->order_id;

        foreach ($cart as $item) {
            $order_line= new order_lines();
            $order_line->order_id=$order_id;
            $order_line->item_id=$item->item_id;
            $order_line->order_qty=$item->quantity;
            $order_line->price=$item->item_price;
            $order_line->save();
        } 
        
        // Clear the cart after checkout
        DB::table('cart')
            ->where('user_id', Auth::id())
            ->delete();
        


        // Process the checkout logic here
        // For example, create an order, charge the user, etc.

        return redirect()->route('cart.index')->with('success', 'Checkout successful! Total: ' . $total);
    }
   
}
