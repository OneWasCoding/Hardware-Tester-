@extends('layouts.app')

@section('content')
<style>
    /* Variables - Updated color scheme and design elements */
    :root {
        --primary-color: #e63946; /* New vibrant red */
        --primary-dark: #c1121f;
        --secondary-color: #1d3557; /* Darker blue for better contrast */
        --accent-color: #fca311; /* Warmer yellow */
        --text-light: #f8f9fa;
        --text-dark: #212529;
        --gray-light: #dee2e6;
        --gray-medium: #adb5bd;
        --bg-light: #f8f9fa;
        --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        --radius: 0.375rem; /* Slightly smaller radius */
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
    }

    body {
        background-color: var(--bg-light);
    }

    /* Hero Section - Updated with diagonal design elements */
    .hero-section {
        background: linear-gradient(135deg, rgba(29,53,87,0.9), rgba(29,53,87,0.7)), 
                    url('/api/placeholder/1920/500');
        background-size: cover;
        background-position: center;
        min-height: 480px;
        padding: 4rem 0;
        margin-top: -1.5rem;
        color: var(--text-light);
        position: relative;
        display: flex;
        align-items: center;
        clip-path: polygon(0 0, 100% 0, 100% 92%, 0 100%);
    }

    .hero-content {
        max-width: 650px;
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 3.75rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        position: relative;
        display: inline-block;
    }

    .hero-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 80px;
        height: 5px;
        background-color: var(--accent-color);
        border-radius: 5px;
    }

    .hero-search {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: var(--radius);
        padding: 1rem;
        box-shadow: var(--shadow-lg);
        transition: var(--transition);
    }

    .hero-search:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .hero-search .form-control {
        background: rgba(255, 255, 255, 0.95);
        border-radius: calc(var(--radius) - 0.125rem);
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
        border: 2px solid transparent;
        transition: var(--transition);
    }

    .hero-search .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(252, 163, 17, 0.25);
    }

    .hero-badge {
        position: absolute;
        top: -25px;
        right: -30px;
        background: var(--accent-color);
        color: var(--text-dark);
        font-weight: bold;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        transform: rotate(8deg);
        box-shadow: var(--shadow-md);
        border: 2px solid rgba(255, 255, 255, 0.5);
    }

    /* Filter Section - Updated with card design */
    .filter-section {
        background: white;
        border-radius: var(--radius);
        padding: 1.75rem;
        margin-bottom: 2.5rem;
        box-shadow: var(--shadow-md);
        border-top: 5px solid var(--primary-color);
        position: relative;
        margin-top: -2rem;
        z-index: 10;
    }

    .filter-section h3 {
        color: var(--secondary-color);
        font-weight: 700;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
    }
    
    .filter-section h3 i {
        margin-right: 0.75rem;
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
        align-items: end;
    }

    .form-label {
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        border: 1px solid var(--gray-light);
        padding: 0.625rem 0.875rem;
        transition: var(--transition);
        border-radius: var(--radius);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(230, 57, 70, 0.15);
    }

    /* Product Grid - Updated with modern layout */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2.5rem;
    }

    .product-card {
        background: white;
        border-radius: var(--radius);
        overflow: hidden;
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-light);
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-7px);
        box-shadow: var(--shadow-lg);
    }

    .product-image {
        position: relative;
        padding-top: 75%;
        overflow: hidden;
        background: #f8f9fa;
    }

    .product-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: var(--transition);
        padding: 0.5rem;
    }

    .product-card:hover .product-image img {
        transform: scale(1.08);
    }
    
    .product-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: var(--accent-color);
        color: var(--text-dark);
        font-weight: 700;
        font-size: 0.8rem;
        padding: 0.3rem 0.75rem;
        border-radius: 50px;
        z-index: 1;
        box-shadow: var(--shadow-sm);
        letter-spacing: 0.5px;
    }

    .product-content {
        padding: 1.75rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        border-top: 1px solid var(--gray-light);
        position: relative;
    }

    .product-title {
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--secondary-color);
        transition: var(--transition);
    }

    .product-card:hover .product-title {
        color: var(--primary-color);
    }

    .product-price {
        font-size: 1.65rem;
        font-weight: 800;
        color: var(--primary-color);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
    }

    .product-price::before {
        content: '₱';
        font-size: 1.1rem;
        font-weight: 700;
        margin-right: 0.25rem;
        opacity: 0.8;
    }

    .product-stock {
        color: #2f855a;
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        font-weight: 600;
    }
    
    .stock-low {
        color: #c53030;
    }

    .product-stock i {
        margin-right: 0.5rem;
    }

    .item-code {
        font-family: monospace;
        background: #f1f1f1;
        padding: 0.3rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
        color: var(--secondary-color);
        margin-bottom: 0.75rem;
        display: inline-block;
    }

    .quantity-input {
        width: 80px !important;
        text-align: center;
        margin-right: 1rem;
        border: 2px solid var(--gray-light);
        font-weight: 600;
    }

    .add-to-cart-btn {
        width: 100%;
        padding: 0.875rem;
        border-radius: var(--radius);
        font-weight: 600;
        transition: var(--transition);
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.95rem;
    }
    
    .add-to-cart-btn:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-2px);
    }

    .add-to-cart-btn:active {
        transform: translateY(1px);
    }

    /* Section Headers - Updated with better visual hierarchy */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid var(--gray-light);
        position: relative;
    }

    .section-header::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 100px;
        height: 3px;
        background-color: var(--primary-color);
    }
    
    .section-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--secondary-color);
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-right: 0.75rem;
        color: var(--primary-color);
    }

    /* Alert Styling */
    .alert {
        border-radius: var(--radius);
        margin-bottom: 2rem;
        border-left: 5px solid;
    }

    .alert-success {
        border-left-color: #2f855a;
    }

    .alert-warning {
        border-left-color: #c05621;
    }
    
    /* Category Pills */
    .category-pill {
        display: inline-block;
        background: #f3f4f6;
        color: var(--secondary-color);
        font-size: 0.8rem;
        padding: 0.35rem 0.85rem;
        border-radius: 50px;
        margin-bottom: 0.75rem;
        font-weight: 600;
        border: 1px solid var(--gray-light);
        transition: var(--transition);
    }

    .category-pill:hover {
        background: var(--gray-light);
    }
    
    /* Product Features */
    .product-features {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.25rem;
    }
    
    .feature-tag {
        display: flex;
        align-items: center;
        background: #f8f9fa;
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
        border-radius: 4px;
        color: var(--text-dark);
        border: 1px dashed var(--gray-medium);
        transition: var(--transition);
    }

    .feature-tag:hover {
        background: var(--gray-light);
        border-style: solid;
    }
    
    .feature-tag i {
        font-size: 0.7rem;
        margin-right: 0.35rem;
        color: var(--primary-color);
    }

    /* Product description */
    .product-desc {
        margin-bottom: 1.25rem;
        line-height: 1.5;
        color: #495057;
    }

    /* Pagination Styling - Updated with improved visual design */
    .pagination-container {
        margin-top: 4rem;
        margin-bottom: 3rem;
        display: flex;
        flex-direction: column;
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
        border-radius: var(--radius);
        border: 1px solid var(--gray-light);
        color: var(--text-dark);
        font-weight: 600;
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
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .pagination-info {
        color: #6c757d;
        font-size: 0.95rem;
        text-align: center;
        margin-bottom: 0.75rem;
        font-weight: 500;
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        border: 1px solid var(--gray-light);
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

    /* Button styles */
    .btn {
        border-radius: var(--radius);
        padding: 0.625rem 1.25rem;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .btn-warning {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        color: var(--text-dark);
    }

    .btn-warning:hover {
        background-color: #e29100;
        border-color: #e29100;
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.75rem;
        }
        
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .filter-form {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section mb-5">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                Contractor Discounts Available!
            </div>
            <h1 class="hero-title">Pro-Grade Tools & Supplies</h1>
            <p class="lead mb-4">Everything you need for your next project — professional quality, competitive prices</p>
            <div class="hero-search">
                <form class="d-flex gap-2" action="{{ route('home') }}" method="GET">
                    <input type="search" name="search" class="form-control"
                           placeholder="Search for tools, hardware, lumber..."
                           value="{{ request('search') }}">
                    
                    <!-- Select search type -->
                    <select name="search_type" class="form-select w-auto">
                        <option value="like" {{ request('search_type') === 'like' ? 'selected' : '' }}>Basic</option>
                        <option value="scope" {{ request('search_type') === 'scope' ? 'selected' : '' }}>Category</option>
                        <option value="scout" {{ request('search_type') === 'scout' ? 'selected' : '' }}>Advanced</option>
                    </select>

                    <button class="btn btn-warning px-4" type="submit">
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
        <h3><i class="fas fa-filter"></i> Filter Products</h3>
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
                       class="form-control" placeholder="₱10000">
            </div>
            <div class="form-group">
                <label class="form-label">Department</label>
                <select name="category_id" class="form-select">
                    <option value="">All Departments</option>
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
        <div class="section-header">
            <h2 class="section-title"><i class="fas fa-tools"></i> Featured Products</h2>
            <a href="#" class="btn btn-sm btn-outline-primary">View All Products</a>
        </div>
        
        @if ($items->count())
            <div class="product-grid">
                @foreach ($items as $item)
                    <div class="product-card">
                        @if($loop->index % 3 == 0)
                            <div class="product-badge">BEST SELLER</div>
                        @elseif($loop->index % 5 == 0)
                            <div class="product-badge">NEW</div>
                        @endif
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
                            <div class="category-pill">
                                {{ $categories->firstWhere('category_id', $item->category_id)->category_name ?? 'Hardware' }}
                            </div>
                            <h3 class="product-title">{{ $item->item_name }}</h3>
                            <div class="item-code">SKU: HDWR-{{ $item->item_id }}</div>
                            
                            <div class="product-features">
                                <span class="feature-tag"><i class="fas fa-check-circle"></i> Pro-Grade</span>
                                @if($loop->index % 2 == 0)
                                <span class="feature-tag"><i class="fas fa-battery-full"></i> Cordless</span>
                                @endif
                                @if($loop->index % 3 == 0)
                                <span class="feature-tag"><i class="fas fa-shield-alt"></i> 5-Yr Warranty</span>
                                @endif
                            </div>
                            
                            <p class="product-desc text-muted">{{ Str::limit($item->item_desc, 80) }}</p>
                            <div class="product-price">{{ number_format($item->item_price, 2) }}</div>
                            
                            @php
                                $stockClass = $item->stock_quantity < 10 ? 'stock-low' : '';
                                $stockIcon = $item->stock_quantity < 10 ? 'fa-exclamation-triangle' : 'fa-check-circle';
                            @endphp
                            
                            <div class="product-stock {{ $stockClass }}">
                                <i class="fas {{ $stockIcon }}"></i> 
                                @if($item->stock_quantity > 20)
                                    In Stock ({{ $item->stock_quantity }} units)
                                @elseif($item->stock_quantity > 0)
                                    Limited Stock ({{ $item->stock_quantity }} remaining)
                                @else
                                    Out of Stock
                                @endif
                            </div>
                            
                            <form action="{{ route('cart.add', $item->item_id) }}" method="POST" class="mt-auto">
                                @csrf
                                <div class="d-flex align-items-center mb-3">
                                    <input type="number" name="quantity" value="1" 
                                           min="1" max="{{ $item->stock_quantity }}" 
                                           class="form-control quantity-input">
                                    <span class="text-muted">Unit(s)</span>
                                </div>
                                <button type="submit" class="btn btn-primary add-to-cart-btn" {{ $item->stock_quantity <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination with FontAwesome icons -->
            <div class="pagination-container">
                @if ($items->total() > 0)
                    <div class="pagination-info">
                        Showing {{ $items->firstItem() }}-{{ $items->lastItem() }} of {{ $items->total() }} products
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
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-circle me-2"></i>
                No items found matching your search. Try adjusting your filters or search terms.
            </div>
        @endif
    </section>
</div>
@endsection