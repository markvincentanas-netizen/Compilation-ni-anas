@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Product</h1>

    <!-- Back button -->
    <a href="{{ route('groceries.index') }}" class="btn back">⬅ Back to Products</a>

    <!-- Validation errors -->
    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Add Product Form -->
    <form action="{{ route('groceries.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" name="category" id="category" value="{{ old('category') }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value="{{ old('price') }}" required>
        </div>

        <div class="form-group">
            <label for="expiry_date">Expiry Date:</label>
            <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date') }}">
        </div>

        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" name="image" id="image">
        </div>

        <button type="submit" class="btn">Add Product</button>
    </form>
</div>
@endsection