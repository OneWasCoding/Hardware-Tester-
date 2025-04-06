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

    <!-- Filtering Form -->
    <form action="{{ route('home') }}" method="GET" class="d-flex align-items-center gap-2">
        <input type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}" class="form-control" />
        <input type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}" class="form-control" />
    
        <select name="category_id" class="form-control">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->category_id }}" {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    
        <button type="submit" class="btn btn-primary">Filter</button>
    
        <a href="{{ route('home') }}" class="btn btn-secondary">Reset</a>
    </form>
    

    <!-- Featured Products -->
    <section class="mb-5">
        <div class="container">
            <h2>Items for Sale</h2>
    
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <a href="{{ route('item.show', $item->item_id) }}">
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
                                <p class="card-text"><strong>In Stock:</strong> {{ $item->stock_quantity }}</p>
    
                                <form action="{{ route('cart.add', $item->item_id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $item->stock_quantity }}" class="form-control mb-3" style="width: 60px;" >
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>