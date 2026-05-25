@extends('layouts.app')

@section('content')
<div class="view-container">

    <!-- Product Card -->
    <div class="product-card">

        <!-- Product Image -->
        @if($grocery->image)
            <img src="{{ asset('storage/'.$grocery->image) }}" class="view-img">
        @else
            <div class="no-image">No Image</div>
        @endif

        <!-- Product Details -->
        <div class="product-details">
            <h2>{{ $grocery->name }}</h2>

            <p><strong>Category:</strong> {{ $grocery->category }}</p>
            <p><strong>Quantity:</strong> {{ $grocery->quantity }}</p>
            <p><strong>Price:</strong> ₱{{ $grocery->price }}</p>
            <p><strong>Expiry Date:</strong> {{ $grocery->expiry_date ?? 'N/A' }}</p>
        </div>

        <!-- Bottom Button -->
        <div class="product-actions">
            <a href="{{ route('groceries.index') }}" class="btn back full">Back to Products</a>
        </div>

    </div>
</div>
@endsection