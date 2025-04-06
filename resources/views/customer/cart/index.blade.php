@extends('layouts.app')
<?php 
// dd($cartItems);
?>
@section('content')
<div class="container">
    <h2>Your Cart</h2>
    
    <!-- Main update form -->
    <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        @method('PUT')
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item Name</th>
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
                        <td><img src="{{ asset('storage/item_gallery/' . $cartItem->img_name) }}" alt="{{ $cartItem->item_name }}" style="width: 50px; height: auto;"></td>
                        <td>{{ $cartItem->item_name }}</td>
                        <td>{{ $cartItem->item_desc }}</td>
                        <td>₱{{ number_format($cartItem->item_price, 2) }}</td>
                        <td>
                            <input type="number" 
                                   name="quantity[{{ $cartItem->cart_id }}]" 
                                   value="{{ min($cartItem->quantity, $cartItem->stock_quantity ?? 0) }}" 
                                   min="1" 
                                   max="{{ $cartItem->stock_quantity ?? 0 }}" 
                                   class="form-control quantity-input" 
                                   style="width: 80px;"
                                   data-stock="{{ $cartItem->stock_quantity ?? 0 }}">
                            
                            @if(($cartItem->stock_quantity ?? 0) < 5)
                                <small class="text-danger">Only {{ $cartItem->stock_quantity ?? 0 }} left!</small>
                            @endif
                            
                            @if(($cartItem->stock_quantity ?? 0) < $cartItem->quantity)
                                <div class="text-danger mt-1">
                                    <small><strong>Note:</strong> Quantity adjusted to available stock</small>
                                </div>
                            @endif
                        </td>
                        <td>₱{{ number_format($cartItem->item_price * min($cartItem->quantity, $cartItem->stock_quantity ?? $cartItem->quantity), 2) }}</td>
                        <td>
                            <button type="button" class="btn btn-danger delete-item" data-id="{{ $cartItem->cart_id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="alert alert-info stock-warning" style="display: none;">
            <strong>Note:</strong> Some quantities have been adjusted to match available stock.
        </div>
        
        <button type="submit" class="btn btn-success">Update Cart</button>
        <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
    </form>
    
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