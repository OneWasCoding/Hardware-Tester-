@extends('layouts.app')

@section('content')
<style>
    /* Variables */
    :root {
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --text-light: #f3f4f6;
        --text-dark: #1f2937;
        --gray-light: #e5e7eb;
        --transition: all 0.3s ease;
    }

    /* Product Detail */
    .product-detail {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }
    
    /* Image Gallery */
    .gallery-container {
        position: relative;
        overflow: hidden;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .main-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 0.5rem;
    }
    
    .thumbnail-container {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }
    
    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 0.5rem;
        cursor: pointer;
        border: 2px solid transparent;
        transition: var(--transition);
    }
    
    .thumbnail:hover, .thumbnail.active {
        border-color: var(--primary-color);
        transform: scale(1.05);
    }
    
    /* Product Info */
    .product-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .product-price {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }
    
    .product-desc {
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }
    
    .stock-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .in-stock {
        color: #10b981;
    }
    
    .low-stock {
        color: #f59e0b;
    }
    
    .out-of-stock {
        color: #ef4444;
    }
    
    /* Quantity Selector */
    .quantity-selector {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .quantity-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f3f4f6;
        border: none;
        border-radius: 0.5rem;
        font-size: 1.25rem;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .quantity-btn:hover {
        background-color: #e5e7eb;
    }
    
    .quantity-input {
        width: 60px;
        height: 40px;
        text-align: center;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        margin: 0 0.5rem;
        font-size: 1rem;
    }
    
    .add-to-cart-btn {
        width: 100%;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: var(--transition);
    }
    
    /* Reviews Section */
    .reviews-section {
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .rating-summary {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .rating-stars {
        color: #f59e0b;
        font-size: 1.25rem;
    }
    
    .review-count {
        color: #6b7280;
    }
    
    .review-item {
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem 0;
    }
    
    .review-item:last-child {
        border-bottom: none;
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }
    
    .reviewer-name {
        font-weight: 600;
    }
    
    .review-date {
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .review-rating {
        margin-bottom: 0.5rem;
    }
    
    .review-comment {
        line-height: 1.6;
    }
    
    /* Review Form */
    .review-form {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .star-rating {
        display: flex;
        gap: 0.25rem;
        margin-bottom: 1rem;
    }
    
    .star-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #d1d5db;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .star-btn.active, .star-btn:hover {
        color: #f59e0b;
    }
    
    /* Related Products */
    .related-products {
        margin-bottom: 3rem;
    }
    
    .related-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
</style>

<div class="container mt-4">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $item->item_name }}</li>
        </ol>
    </nav>

    <!-- Product Detail Section -->
    <div class="product-detail">
        <div class="row g-0">
            <!-- Image Gallery -->
            <div class="col-md-6 p-4">
                <div class="gallery-container">
                    <img id="mainImage" src="{{ asset('storage/item_gallery/' . $images[0]->img_name) }}" alt="{{ $item->item_name }}" class="main-image">
                    
                    @if(count($images) > 1)
                        <div class="thumbnail-container">
                            @foreach($images as $index => $image)
                                <img src="{{ asset('storage/item_gallery/' . $image->img_name) }}" 
                                     alt="{{ $item->item_name }} image {{ $index + 1 }}" 
                                     class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                     onclick="changeMainImage(this, '{{ asset('storage/item_gallery/' . $image->img_name) }}')">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="col-md-6 p-4">
                <h1 class="product-title">{{ $item->item_name }}</h1>
                <div class="product-price">₱{{ number_format($item->item_price, 2) }}</div>
                
                <!-- Rating Summary -->
                <div class="rating-summary mb-3">
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($avgRating))
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="review-count">{{ $reviews->count() }} {{ Str::plural('review', $reviews->count()) }}</span>
                </div>
                
                <div class="product-desc">
                    {{ $item->item_desc }}
                </div>
                
                <div class="stock-info">
                    @if($stock > 10)
                        <i class="fas fa-check-circle in-stock"></i>
                        <span class="in-stock">In Stock ({{ $stock }} available)</span>
                    @elseif($stock > 0)
                        <i class="fas fa-exclamation-circle low-stock"></i>
                        <span class="low-stock">Low Stock ({{ $stock }} left)</span>
                    @else
                        <i class="fas fa-times-circle out-of-stock"></i>
                        <span class="out-of-stock">Out of Stock</span>
                    @endif
                </div>
                
                @if($stock > 0)
                    <form action="{{ route('cart.add', $item->item_id) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn" onclick="decrementQuantity()">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $stock }}" class="quantity-input" readonly>
                            <button type="button" class="quantity-btn" onclick="incrementQuantity()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        
                        <button type="submit" class="btn btn-primary add-to-cart-btn">
                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                        </button>
                    </form>
                @else
                    <button class="btn btn-secondary add-to-cart-btn" disabled>
                        <i class="fas fa-shopping-cart me-2"></i>Out of Stock
                    </button>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Reviews Section -->
    <div class="reviews-section">
        <h2 class="section-title">
            <i class="fas fa-comments me-2"></i>Customer Reviews
        </h2>
        
        <div class="rating-summary">
            <div class="rating-stars">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= round($avgRating))
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
            </div>
            <span class="fw-bold">{{ number_format($avgRating, 1) }}/5</span>
            <span class="review-count">({{ $reviews->count() }} {{ Str::plural('review', $reviews->count()) }})</span>
        </div>
        
        @if($reviews->count() > 0)
            <div class="reviews-list">
                @foreach($reviews as $review)
                    <div class="review-item">
                        <div class="review-header">
                            <span class="reviewer-name">{{ $review->username }}</span>
                            <span class="review-date">{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</span>
    
                            <!-- Display Edit Icon if the logged-in user is the reviewer -->
                            @if(Auth::check() && Auth::id() == $review->user_id)
                                <a href="{{ route('review.edit', parameters: ['item_id' => $item->item_id, 'review_id' => $review->review_id]) }}">
                                    <i class="fas fa-edit" style="color: #007bff;"></i> Edit
                                </a>
                            @endif
                        </div>
                        <div class="review-rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <i class="fas fa-star" style="color: #f59e0b;"></i>
                                @else
                                    <i class="far fa-star" style="color: #f59e0b;"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="review-comment">
                            {{ $review->comment }}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No reviews yet. Be the first to review this product!</p>
        @endif
        
        <!-- Review Form -->
        @auth
            <div class="review-form">
                <h3 class="h5 mb-3">Write a Review</h3>
                <form action="{{ route('item.review', $item->item_id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div class="star-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" class="star-btn" data-rating="{{ $i }}" onclick="setRating({{ $i }})">
                                    <i class="far fa-star"></i>
                                </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating" value="0" required>
                        @error('rating')
                            <div class="text-danger">{{ $errors->first('rating') }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Review</label>
                        <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                        @error('comment')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        @else
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in to Write a Review</a>
            </div>
        @endauth
    </div>
    
    <!-- Related Products -->
    @if($relatedItems->count() > 0)
        <div class="related-products">
            <h2 class="related-title">You May Also Like</h2>
            <div class="related-grid">
                @foreach($relatedItems as $relatedItem)
                    <div class="product-card">
                        <a href="{{ route('item.show', $relatedItem->item_id) }}" class="product-image">
                            <img src="{{ asset('storage/item_gallery/' . $relatedItem->image) }}" alt="{{ $relatedItem->item_name }}">
                        </a>
                        <div class="product-content">
                            <h3 class="product-title">{{ $relatedItem->item_name }}</h3>
                            <div class="product-price">₱{{ number_format($relatedItem->item_price, 2) }}</div>
                            <a href="{{ route('item.show', $relatedItem->item_id) }}" class="btn btn-outline-primary mt-2 w-100">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- JavaScript for the page functionality -->
<script>
    // Image Gallery
    function changeMainImage(thumbnail, newSrc) {
        // Update main image source
        document.getElementById('mainImage').src = newSrc;
        
        // Update active thumbnail
        const thumbnails = document.querySelectorAll('.thumbnail');
        thumbnails.forEach(thumb => {
            thumb.classList.remove('active');
        });
        thumbnail.classList.add('active');
    }
    
    // Quantity Selector
    function incrementQuantity() {
        const input = document.getElementById('quantity');
        const maxValue = parseInt(input.getAttribute('max'));
        let value = parseInt(input.value);
        
        if (value < maxValue) {
            input.value = value + 1;
        }
    }
    
    function decrementQuantity() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        
        if (value > 1) {
            input.value = value - 1;
        }
    }
    
    // Star Rating
    function setRating(rating) {
        document.getElementById('rating').value = rating;
        
        const stars = document.querySelectorAll('.star-btn');
        stars.forEach((star, index) => {
            const starIcon = star.querySelector('i');
            if (index < rating) {
                starIcon.classList.remove('far');
                starIcon.classList.add('fas');
                star.classList.add('active');
            } else {
                starIcon.classList.remove('fas');
                starIcon.classList.add('far');
                star.classList.remove('active');
            }
        });
    }
</script>
@endsection