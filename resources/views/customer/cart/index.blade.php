@extends('layouts.app')
<?php 
// dd($cartItems);
?>
@section('content')
<div class="container">
    <h2 class="mb-4">Your Hardware Cart</h2>
    
    <!-- Main update form -->
    <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fa fa-tools mr-2"></i> Cart Items</h5>
                    <span class="badge badge-warning">Items may require additional handling fees for delivery</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $cartItem)
                                <tr>
                                    <td><img src="{{ asset('storage/item_gallery/' . $cartItem->img_name) }}" alt="{{ $cartItem->item_name }}" class="img-thumbnail" style="width: 70px; height: auto;"></td>
                                    <td class="font-weight-bold text-secondary">{{ $cartItem->item_name }}</td>
                                    <td><small class="text-muted">{{ $cartItem->item_desc }}</small></td>
                                    <td class="text-nowrap">₱{{ number_format($cartItem->item_price, 2) }}</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" 
                                                name="quantity[{{ $cartItem->cart_id }}]" 
                                                value="{{ min($cartItem->quantity, $cartItem->stock_quantity ?? 0) }}" 
                                                min="1" 
                                                max="{{ $cartItem->stock_quantity ?? 0 }}" 
                                                class="form-control quantity-input" 
                                                style="width: 80px; border-color: #e67e22;"
                                                data-stock="{{ $cartItem->stock_quantity ?? 0 }}">
                                        </div>
                                        
                                        @if(($cartItem->stock_quantity ?? 0) < 5)
                                            <small class="text-danger"><i class="fa fa-exclamation-triangle"></i> Only {{ $cartItem->stock_quantity ?? 0 }} left!</small>
                                        @endif
                                        
                                        @if(($cartItem->stock_quantity ?? 0) < $cartItem->quantity)
                                            <div class="text-danger mt-1">
                                                <small><i class="fa fa-info-circle"></i> <strong>Note:</strong> Quantity adjusted to available stock</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-nowrap font-weight-bold">₱{{ number_format($cartItem->item_price * min($cartItem->quantity, $cartItem->stock_quantity ?? $cartItem->quantity), 2) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger delete-item" data-id="{{ $cartItem->cart_id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="alert alert-info stock-warning" style="display: none; border-left: 4px solid #3498db;">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fa fa-info-circle fa-2x text-info"></i>
                        </div>
                        <div>
                            <strong>Inventory Notice:</strong> Some quantities have been adjusted to match available stock.
                            <p class="mb-0 small">Please contact our store for bulk orders or special requests.</p>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-sync-alt mr-1"></i> Update Cart
                    </button>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">
                        <i class="fa fa-shopping-cart mr-1"></i> Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </form>
    
    <!-- Product suggestions -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"><i class="fa fa-hammer mr-2"></i> You Might Also Need</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-screwdriver fa-2x mb-2 text-secondary"></i>
                            <h6>Power Tools</h6>
                            <a href="#" class="btn btn-sm btn-outline-secondary">Browse</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-hard-hat fa-2x mb-2 text-warning"></i>
                            <h6>Safety Equipment</h6>
                            <a href="#" class="btn btn-sm btn-outline-secondary">Browse</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-paint-roller fa-2x mb-2 text-primary"></i>
                            <h6>Paint Supplies</h6>
                            <a href="#" class="btn btn-sm btn-outline-secondary">Browse</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-ruler-combined fa-2x mb-2 text-danger"></i>
                            <h6>Measuring Tools</h6>
                            <a href="#" class="btn btn-sm btn-outline-secondary">Browse</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Hidden form for delete actions -->
    <form id="delete-form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    
    <!-- JavaScript to handle delete actions and quantity validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete item handling
            const deleteButtons = document.querySelectorAll('.delete-item');
            const deleteForm = document.getElementById('delete-form');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if(confirm('Are you sure you want to remove this item?')) {
                        const itemId = this.getAttribute('data-id');
                        deleteForm.action = "{{ route('cart.delete', '') }}/" + itemId;
                        deleteForm.submit();
                    }
                });
            });
            
            // Check if we need to show the stock warning
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const stockWarning = document.querySelector('.stock-warning');
            
            // Show warning if any quantities were adjusted on page load
            let needsWarning = false;
            quantityInputs.forEach(input => {
                const stock = parseInt(input.getAttribute('data-stock')) || 0;
                const value = parseInt(input.value) || 0;
                
                if (value > 0 && stock > 0 && value >= stock) {
                    needsWarning = true;
                }
            });
            
            if (needsWarning) {
                stockWarning.style.display = 'block';
            }
            
            // Quantity validation against stock
            quantityInputs.forEach(input => {
                input.addEventListener('input', function() {
                    validateQuantity(this);
                });
            });
            
            function validateQuantity(input) {
                const stock = parseInt(input.getAttribute('data-stock')) || 0;
                const quantity = parseInt(input.value) || 1;
                
                if (quantity > stock && stock > 0) {
                    input.value = stock;
                    stockWarning.style.display = 'block';
                }
                
                // Update row total on quantity change
                updateRowTotal(input);
            }
            
            function updateRowTotal(input) {
                const row = input.closest('tr');
                const priceCell = row.querySelector('td:nth-child(4)');
                const totalCell = row.querySelector('td:nth-child(6)');
                
                // Extract price (remove ₱ and convert to number)
                const price = parseFloat(priceCell.textContent.replace('₱', '').replace(',', ''));
                const quantity = parseInt(input.value) || 0;
                
                // Update total with peso sign
                const total = price * quantity;
                totalCell.textContent = '₱' + total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            }
        });
    </script>
</div>
@endsection