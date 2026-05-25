@extends('layouts.app')

@section('content')
<div class="wrapper">

    <!-- SIDEBAR is included in layouts.app -->

    <div class="main-content">
        <div class="form">
            <h1>Edit Product</h1>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Form -->
            <form action="{{ route('groceries.update', $grocery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Image Preview -->
                @if($grocery->image)
                    <img src="{{ asset('storage/'.$grocery->image) }}" class="view-img">
                @else
                    <div class="no-image">No Image</div>
                @endif

                <div class="form-group">
                    <label>Product Name:</label>
                    <input type="text" name="name" value="{{ old('name', $grocery->name) }}" required>
                </div>

                <div class="form-group">
                    <label>Category:</label>
                    <input type="text" name="category" value="{{ old('category', $grocery->category) }}" required>
                </div>

                <div class="form-group">
                    <label>Quantity:</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $grocery->quantity) }}" required>
                </div>

                <div class="form-group">
                    <label>Price:</label>
                    <input type="text" name="price" value="{{ old('price', $grocery->price) }}" required>
                </div>

                <div class="form-group">
                    <label>Expiry Date:</label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', $grocery->expiry_date) }}">
                </div>

                <div class="form-group">
                    <label>Change Image:</label>
                    <input type="file" name="image">
                </div>

                <div class="product-actions">
                    <button type="submit" class="btn full">Update Product</button>
                    <a href="{{ route('groceries.index') }}" class="btn back full">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection