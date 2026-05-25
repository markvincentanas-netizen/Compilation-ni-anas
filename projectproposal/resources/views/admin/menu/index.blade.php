@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">🍽️ OnlineCanteen Menu</h1>
        <p class="lead text-muted">Browse • Select • Order</p>
    </div>

    <div class="alert alert-info">
        Total Categories: <strong>{{ $categories->count() }}</strong> | 
        Total Menu Items: <strong>{{ \App\Models\MenuItem::count() }}</strong>
    </div>

    @if($categories->isEmpty())
        <div class="alert alert-danger text-center p-5">
            <h4>No categories found!</h4>
            <p>Please run the seeder again.</p>
        </div>
    @else
        @foreach($categories as $category)
            <h3 class="mt-5 mb-4 fw-bold text-primary">{{ $category->name }} ({{ $category->menuItems->count() }} items)</h3>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($category->menuItems as $item)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ $item->image ?? 'https://picsum.photos/400/250' }}" 
                                 class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5>{{ $item->name }}</h5>
                                <p class="text-muted small">{{ $item->description }}</p>
                                <h4 class="text-success">₱{{ number_format($item->price, 2) }}</h4>
                            </div>
                            <div class="card-footer bg-white">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
@endsection