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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Featured Products</h2>
            {{-- <a href="#" class="btn btn-outline-primary">View All</a> --}}
        </div>
        <div class="row g-4">
            @php
                $products = [
                    [
                        'name' => 'Wireless Earbuds',
                        'price' => 79.99,
                        'original_price' => 99.99,
                        'discount' => 20,
                        'image' => 'https://via.placeholder.com/300x200'
                    ],
                    [
                        'name' => 'Smart Watch',
                        'price' => 199.99,
                        'original_price' => 249.99,
                        'discount' => 20,
                        'image' => 'https://via.placeholder.com/300x200'
                    ],
                    [
                        'name' => 'Gaming Headset',
                        'price' => 89.99,
                        'original_price' => 129.99,
                        'discount' => 30,
                        'image' => 'https://via.placeholder.com/300x200'
                    ],
                    [
                        'name' => 'Mechanical Keyboard',
                        'price' => 149.99,
                        'original_price' => 199.99,
                        'discount' => 25,
                        'image' => 'https://via.placeholder.com/300x200'
                    ]
                ];
            @endphp

            @foreach($products as $product)
            <div class="col-md-3">
                <div class="product-card">
                    <div class="position-relative">
                        <img src="{{ $product['image'] }}" class="product-img w-100" alt="{{ $product['name'] }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <div class="d-flex align-items-center mb-2">
                            <span class="price me-2">${{ $product['price'] }}</span>
                        </div>
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
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