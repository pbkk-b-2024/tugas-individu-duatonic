<!-- resources/views/items/create.blade.php -->

@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Add New Item</h1>

        <form action="{{ route('items.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>

            <button type="submit" class="btn btn-success">Add Item</button>
        </form>
    </div>
@endsection