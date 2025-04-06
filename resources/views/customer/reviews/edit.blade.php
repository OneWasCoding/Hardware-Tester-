<!-- resources/views/reviews/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Review</h2>
    
    <!-- Form to Edit Review -->
    <form action="{{ route('review.update', ['item_id' => $item_id, 'review_id' => $review->review_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Rating -->
        <div class="form-group">
            <label for="rating">Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" id="rating" min="1" max="5" value="{{ old('rating', $review->rating) }}" required>
        </div>

        <!-- Comment -->
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea name="comment" class="form-control" id="comment" rows="4" required>{{ old('comment', $review->comment) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Review</button>
    </form>
</div>
@endsection
