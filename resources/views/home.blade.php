@extends('layouts.app')

@section('content')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        padding: 1rem 0;
        margin-top: -1.5rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-search {
        max-width: 600px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 1rem;
        padding: 0.5rem;
    }



    /* Product Cards */
    .product-card {
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .product-card:hover {
        border-color: #2563eb;
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .product-img {
        height: 200px;
        object-fit: cover;
    }


    .price {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2563eb;
    }

    .original-price {
        text-decoration: line-through;
        color: #9ca3af;
        font-size: 0.875rem;
    }


</style>

<!-- Hero Section -->
<section class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Discover Amazing Keyboards</h1>
                <p class="lead mb-4">Find the best deals on everything you need</p>
                <div class="hero-search">
                    <form class="d-flex">
                        <input type="search" class="form-control form-control-lg border-0 me-2" 
                               placeholder="Search for products...">
                        <button class="btn btn-light px-4" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- Flash Messages -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
{{-- 
    <!-- Categories Section -->
    <section class="mb-5">
        <h2 class="mb-4">Shop by Category</h2>
        <div class="row g-4">
            @php
                $categories = [
                    ['name' => 'Electronics', 'icon' => 'fas fa-laptop', 'image' => 'https://via.placeholder.com/300x150'],
                    ['name' => 'Fashion', 'icon' => 'fas fa-tshirt', 'image' => 'https://via.placeholder.com/300x150'],
                    ['name' => 'Home & Living', 'icon' => 'fas fa-home', 'image' => 'https://via.placeholder.com/300x150'],
                    ['name' => 'Beauty', 'icon' => 'fas fa-spa', 'image' => 'https://via.placeholder.com/300x150']
                ];
            @endphp --}}

            {{-- @foreach($categories as $category)
            <div class="col-md-3">
                <div class="category-card card">
                    <img src="{{ $category['image'] }}" class="category-img" alt="{{ $category['name'] }}">
                    <div class="card-body text-center">
                        <i class="{{ $category['icon'] }} fa-2x mb-2 text-primary"></i>
                        <h5 class="card-title mb-0">{{ $category['name'] }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section> --}}

    <!-- Featured Products -->
    <section class="mb-5">
        <div class="container">
            <h2>Items for Sale</h2>
    
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <!-- Make the image clickable, linking to the item details page -->
                            <a href="{{ route('item.show', $item->item_id) }}">
                                <!-- Display the image if it exists -->
                                @if($item->image)
                                    <img src="{{ asset('storage/item_gallery/' . $item->image) }}" class="card-img-top" alt="{{ $item->item_name }}">
                                @else
                                    <img src="{{ asset('storage/item_gallery/default.jpg') }}" class="card-img-top" alt="{{ $item->item_name }}">
                                @endif
                            </a>
    
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->item_name }}</h5>
                                <p class="card-text">{{ $item->item_desc }}</p>
                                <p class="card-text">Price: ${{ number_format($item->item_price, 2) }}</p>
    
                                <!-- Stock Quantity (Read-only) -->
                                <p class="card-text"><strong>In Stock:</strong> {{ $item->stock_quantity }}</p>
    
                                <!-- Form for adding to cart -->
                                <form action="{{ route('cart.add', $item->item_id) }}" method="POST">
                                    @csrf
                                    
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $item->stock_quantity }}" class="form-control mb-3" style="width: 60px;" >
    
                                    <!-- Add to Cart Button -->
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    

    
    
    
    {{-- <!-- Special Offers -->
    <section class="mb-5">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card bg-primary text-white">
                    <div class="card-body p-4">
                        <h3>Special Offer!</h3>
                        <p class="mb-4">Get 20% off on all electronics this week</p>
                        <a href="#" class="btn btn-light">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-success text-white">
                    <div class="card-body p-4">
                        <h3>New Arrivals</h3>
                        <p class="mb-4">Check out our latest collection</p>
                        <a href="#" class="btn btn-light">View Collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Newsletter Section -->
    {{-- <section class="newsletter-section mb-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8">
                    <h3 class="mb-3">Subscribe to Our Newsletter</h3>
                    <p class="text-muted mb-4">Get updates about new products and special offers!</p>
                    <form class="d-flex justify-content-center">
                        <div class="input-group" style="max-width: 500px;">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- System Information -->
    <div class="system-info text-center">
        <i class="far fa-clock me-2"></i>Current UTC Time: 2025-04-05 06:13:59 | 
        <i class="far fa-user me-2"></i>User: tolits20
    </div>
</div> --}}
@endsection