<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function edit($item_id, $review_id)
    {
        $review = DB::table('reviews')->where('review_id', $review_id)->first();
        
        // Ensure the logged-in user is the one who wrote the review
        if (!$review || $review->user_id != Auth::id()) {
            return redirect()->route('home')->with('error', 'You cannot edit this review');
        }
    
        return view('customer.reviews.edit', compact('review', 'item_id'));
    }
    
    public function update(Request $request, $item_id, $review_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);
    
        // Find the review
        $review = DB::table('reviews')->where('review_id', $review_id)->first();
    
        // Ensure the review exists
        if (!$review) {
            return redirect()->route('home')->with('error', 'Review not found');
        }
    
        // Ensure the logged-in user is the one who wrote the review
        if (Auth::id() !== $review->user_id) {
            return redirect()->route('home')->with('error', 'You can only edit your own reviews');
        }
    
        // Update the review
        DB::table('reviews')
            ->where('review_id', $review_id)
            ->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
                'updated_at' => now(),
            ]);
    
        return redirect()->route('item.show', $item_id)->with('status', 'Review updated successfully!');
    }

}
