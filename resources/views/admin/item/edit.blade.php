<?php
// dd($qty, $item, $item_gallery, $category);
?>

@extends('layouts.base')
@extends('layouts.template')
@section('content')
<div class="content" style="background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
    @endif
    <h2 class="mb-4">Edit Item</h2>
    <form action="{{ route('item.update', ['item' => $item->item_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="item_id" value="{{ $item->item_id }}">

        <div class="form-group mb-4">
            <label for="name" class="form-label">Item Name</label>
            <input 
                type="text" 
                name="item_name" 
                id="name" 
                class="form-control" 
                value="{{ old('name', $item->item_name) }}" 
                placeholder="Enter item name" 
            >
        </div>

        <div class="form-group mb-4">
            <label for="description" class="form-label">Description</label>
            <textarea 
                name="item_desc" 
                id="description" 
                class="form-control" 
                rows="4" 
                placeholder="Enter a brief description of the item" 
                
            >{{ old('description', $item->item_desc) }}</textarea>
        </div>

        <div class="form-group mb-4">
            <label for="price" class="form-label">Price</label>
            <input 
                type="number" 
                name="item_price" 
                id="price" 
                class="form-control" 
                value="{{ old('price', $item->item_price) }}" 
                placeholder="Enter item price" 
                min="0" 
                step="0.01" 
                
            >
        </div>

        <div class="form-group mb-4">
            <label for="image" class="form-label">New Item Images (Multiple)</label>
            <input 
                type="file" 
                name="images[]" 
                id="image" 
                accept="image/*"
                class="form-control"
                multiple
            >
            
            @if($item_gallery->isNotEmpty())
                <div class="mt-3">
                    <label class="form-label">Current Images</label>
                    <div class="row">
                        @foreach ($item_gallery as $image)
                            <div class="col-md-3 mb-3">
                                <img src="{{ asset('storage/item_gallery/' . $image->img_name) }}" 
                                     alt="Item Image" 
                                     width="150" 
                                     class="img-thumbnail">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="form-group mb-4">
            <label for="category" class="form-label">Category</label>
            <select 
                name="category" 
                id="category" 
                class="form-control" 
                >
                <option value="" disabled>Select Category</option>
                @foreach($category as $categories)
                    <option 
                        value="{{ $categories->category_id }}" 
                        {{ $item->category_id == $categories->category_id ? 'selected' : '' }}
                    >
                        {{ $categories->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-4">
            <label for="status" class="form-label">Product Status</label>
            <select 
                name="status" 
                id="status" 
                class="form-control" 
                
            >
                <option value="available" {{ $item->item_status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="out_of_stock" {{ $item->item_status == 'out_of_stock' ? 'selected' : '' }}>Out of stock</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label for="stocks" class="form-label">Stocks</label>
            <input 
                type="number" 
                name="stocks" 
                id="stocks" 
                class="form-control" 
                value="{{ old('stocks', $qty->quantity ?? 0) }}" 
                placeholder="Enter stock quantity" 
                min="0" 
                
            >
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update Item</button>
            <a href="{{ route('item.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection