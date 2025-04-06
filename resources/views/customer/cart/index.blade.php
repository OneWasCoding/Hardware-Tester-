@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Cart</h2>
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
                    <td>${{ number_format($cartItem->item_price, 2) }}</td>
                    <td>{{ $cartItem->quantity }}</td>
                    <td>${{ number_format($cartItem->item_price * $cartItem->quantity, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.delete', $cartItem->cart_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i> <!-- Font Awesome garbage bin icon -->
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
