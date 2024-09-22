<!-- resources/views/items/edit.blade.php -->

@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Item</h1>

        <form action="{{ route('items.update', $item->item_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->item_name }}" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $item->item_category }}" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $item->item_price }}" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $item->item_quantity }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
    </div>
@endsection
