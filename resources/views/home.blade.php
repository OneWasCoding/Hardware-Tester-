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

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        min-height: 400px;
        padding: 3rem 0;
        margin-top: -1.5rem;
        color: var(--text-light);
        position: relative;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50px;
        background: linear-gradient(to bottom right, transparent 49%, white 50%);
    }

    .hero-content {
        max-width: 600px;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .hero-search {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 1rem;
        padding: 0.75rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .hero-search .form-control {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    /* Product Cards */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }

    .product-card {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        position: relative;
        padding-top: 75%;
        overflow: hidden;
    }

    .product-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
    }

    .product-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .product-stock {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .quantity-input {
        width: 80px !important;
        text-align: center;
        margin-right: 1rem;
    }

    .add-to-cart-btn {
        width: 100%;
        padding: 0.75rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: var(--transition);
    }

    /* Alert Styling */
    .alert {
        border-radius: 0.75rem;
        margin-bottom: 2rem;
    }
    
/* Pagination Styling - Fix for large icons */
.pagination svg {
    width: 1.2rem; /* Adjust this value as needed */
    height: 1.2rem; /* Adjust this value as needed */
    font-size: 1.2rem; /* Adjust this value to set the icon size */
}

.pagination .page-item {
    margin: 0 2px;
}

.pagination .page-link {
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
/* Pagination Styling */
.pagination-container {
    margin-top: 3rem;
    margin-bottom: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
}

.pagination {
    display: flex;
    gap: 0.5rem;
    margin: 0;
    padding: 0;
    list-style: none;
}

.page-item {
    margin: 0;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 2.5rem;
    height: 2.5rem;
    padding: 0.5rem;
    border-radius: 0.5rem;
    border: 1px solid var(--gray-light);
    color: var(--text-dark);
    font-weight: 500;
    transition: var(--transition);
    background-color: white;
    text-decoration: none;
}

.page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.page-item.disabled .page-link {
    background-color: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
    opacity: 0.7;
}

.page-link:hover:not(.disabled) {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.pagination-info {
    color: #6c757d;
    font-size: 0.9rem;
    text-align: center;
}

/* Navigation arrows */
.page-nav {
    font-size: 1rem;
    padding: 0.5rem 1rem;
}

.page-nav i {
    width: 1rem;
    height: 1rem;
}

/* Ellipsis styling */
.page-ellipsis {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    color: #6c757d;
}

</style>

<!-- Hero Section -->
<section class="hero-section mb-5">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Discover Amazing Keyboards</h1>
            <p class="lead mb-4">Find your perfect match from our premium collection</p>
            <div class="hero-search">
                <form class="d-flex gap-2" action="{{ route('home') }}" method="GET">
                    <input type="search" name="search" class="form-control"
                           placeholder="Search for your dream keyboard..."
                           value="{{ request('search') }}">
                    
                    <!-- Select search type -->
                    <select name="search_type" class="form-select w-auto">
                        <option value="like" {{ request('search_type') === 'like' ? 'selected' : '' }}>Classic</option>
                        <option value="scope" {{ request('search_type') === 'scope' ? 'selected' : '' }}>Model Scope</option>
                        <option value="scout" {{ request('search_type') === 'scout' ? 'selected' : '' }}>Laravel Scout</option>
                    </select>

                    <button class="btn btn-light px-4" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filtering Section -->
    <div class="filter-section">
        <form action="{{ route('home') }}" method="GET" class="filter-form">
            <!-- Preserve search -->
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="search_type" value="{{ request('search_type') }}">

            <div class="form-group">
                <label class="form-label">Min Price</label>
                <input type="number" name="min_price" value="{{ request('min_price') }}" 
                       class="form-control" placeholder="₱0">
            </div>
            <div class="form-group">
                <label class="form-label">Max Price</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" 
                       class="form-control" placeholder="₱1000">
            </div>
            <div class="form-group">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}" 
                                {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    <section class="mb-5">
        <h2 class="h3 mb-4">Featured Products</h2>
        @if ($items->count())
            <div class="product-grid">
                @foreach ($items as $item)
                    <div class="product-card">
                        <a href="{{ route('item.show', $item->item_id) }}" class="product-image">
                            @if($item->image)
                                <img src="{{ asset('storage/item_gallery/' . $item->image) }}" 
                                     alt="{{ $item->item_name }}">
                            @else
                                <img src="{{ asset('storage/item_gallery/default.jpg') }}" 
                                     alt="{{ $item->item_name }}">
                            @endif
                        </a>
                        <div class="product-content">
                            <h3 class="product-title">{{ $item->item_name }}</h3>
                            <p class="product-desc text-muted">{{ Str::limit($item->item_desc, 100) }}</p>
                            <div class="product-price">₱{{ number_format($item->item_price, 2) }}</div>
                            <div class="product-stock">
                                <i class="fas fa-box"></i> {{ $item->stock_quantity }} in stock
                            </div>
                            
                            <form action="{{ route('cart.add', $item->item_id) }}" method="POST" class="mt-auto">
                                @csrf
                                <div class="d-flex align-items-center mb-3">
                                    <input type="number" name="quantity" value="1" 
                                           min="1" max="{{ $item->stock_quantity }}" 
                                           class="form-control quantity-input">
                                </div>
                                <button type="submit" class="btn btn-primary add-to-cart-btn">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

<!-- Pagination with FontAwesome icons -->
<!-- Improved Pagination -->
<div class="pagination-container">
    @if ($items->total() > 0)
        <div class="pagination-info">
            Showing {{ $items->firstItem() }}-{{ $items->lastItem() }} of {{ $items->total() }} items
        </div>
        
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                <li class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link page-nav" href="{{ $items->previousPageUrl() }}" aria-label="Previous" {{ $items->onFirstPage() ? 'tabindex="-1"' : '' }}>
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>

                @php
                    $start = max(1, $items->currentPage() - 2);
                    $end = min($start + 4, $items->lastPage());
                    $start = max(1, $end - 4);
                @endphp

                {{-- First Page + Ellipsis --}}
                @if($start > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $items->url(1) }}">1</a>
                    </li>
                    @if($start > 2)
                        <li class="page-ellipsis">
                            <span>...</span>
                        </li>
                    @endif
                @endif

                {{-- Page Numbers --}}
                @for ($i = $start; $i <= $end; $i++)
                    <li class="page-item {{ $i == $items->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $items->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Last Page + Ellipsis --}}
                @if($end < $items->lastPage())
                    @if($end < $items->lastPage() - 1)
                        <li class="page-ellipsis">
                            <span>...</span>
                        </li>
                    @endif
                    <li class="page-item">
                        <a class="page-link" href="{{ $items->url($items->lastPage()) }}">{{ $items->lastPage() }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                <li class="page-item {{ $items->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link page-nav" href="{{ $items->nextPageUrl() }}" aria-label="Next" {{ $items->hasMorePages() ? '' : 'tabindex="-1"' }}>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    @endif
</div>
        @else
            <p>No items found matching your search.</p>
        @endif
    </section>
</div>
@endsection