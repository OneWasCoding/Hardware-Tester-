<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Assuming the user is authenticated
        // $userId = auth()->id();
        // $cartItems = Cart::with('item')->where('user_id', $userId)->get();

        return view('cart.index', compact('cartItems'));
    }

    // public function addToCart(Request $request, $itemId)
    // {
    //     $userId = auth()->id();

    //     // Check if the item is already in the cart
    //     $cartItem = Cart::where('user_id', $userId)->where('item_id', $itemId)->first();

    //     if ($cartItem) {
    //         // If it exists, increment the quantity
    //         $cartItem->increment('quantity');
    //     } else {
    //         // If it doesn't exist, create a new cart item
    //         Cart::create([
    //             'user_id' => $userId,
    //             'item_id' => $itemId,
    //             'quantity' => 1,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Item added to cart!');
    // }
    // public function updateCart(Request $request, $cartId)
    // {
    //     $cartItem = Cart::findOrFail($cartId);
    //     $cartItem->update(['quantity' => $request->input('quantity')]);

    //     return redirect()->back()->with('success', 'Cart updated successfully!');
    // }   

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
    // }
}
