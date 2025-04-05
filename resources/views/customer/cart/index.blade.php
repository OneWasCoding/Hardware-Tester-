@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $cartItem)
                <tr>
                    <td>{{ $cartItem->item->item_name }}</td>
                    <td>${{ $cartItem->item->item_price }}</td>
                    <td>{{ $cartItem->quantity }}</td>
                    <td>${{ $cartItem->item->item_price * $cartItem->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
``