@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $item->item_name }}</h2>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/item_gallery/' . $item->item_name . '.jpg' || '.png') }}" class="img-fluid" alt="{{ $item->item_name }}">
        </div>
        <div class="col-md-6">
            <h3>${{ number_format($item->item_price, 2) }}</h3>
            <p>{{ $item->item_desc }}</p>
            <p>Status: <strong>{{ ucfirst($item->item_status) }}</strong></p>
            <p>Quantity Available: <strong>{{ $item->stock->quantity }}</strong></p>

            <!-- Quantity input and Add to Cart button -->
            <div class="d-flex align-items-center">
                <button class="btn btn-secondary" type="button" onclick="decreaseQuantity({{ $item->item_id }})">-</button>
                <input type="number" id="quantity-{{ $item->item_id }}" class="form-control mx-2" value="1" min="1" max="99" style="width: 60px;" readonly>
                <button class="btn btn-secondary" type="button" onclick="increaseQuantity({{ $item->item_id }})">+</button>
            </div>
            <a href="#" class="btn btn-primary mt-2">Add to Cart</a> <!-- Add cart functionality here -->
        </div>
    </div>
</div>
@endsection

<script>
    @foreach ($items as $item)
        // Handle Increase and Decrease of Quantity
        document.getElementById('increase-{{ $item->item_id }}').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity-{{ $item->item_id }}');
            let currentValue = parseInt(quantityInput.value);
            let stockQuantity = parseInt("{{ $quantity_in_stock }}");

            if (currentValue < stockQuantity) {
                quantityInput.value = currentValue + 1;
            } else {
                alert('Maximum stock limit reached.');
            }
        });

        document.getElementById('decrease-{{ $item->item_id }}').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity-{{ $item->item_id }}');
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        // Handle Add to Cart Action
        document.getElementById('add-to-cart-{{ $item->item_id }}').addEventListener('click', function() {
            let quantity = document.getElementById('quantity-{{ $item->item_id }}').value;
            // You can handle cart addition logic here (e.g., AJAX call to add to cart)
            alert('Added ' + quantity + ' of ' + '{{ $item->item_name }}' + ' to your cart!');
        });
    @endforeach
</script>
