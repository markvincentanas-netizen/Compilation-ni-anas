@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-4">🛒 Your Cart</h2>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="card shadow-sm">
                    <div class="card-body">
                        @foreach(session('cart') as $id => $item)
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img src="{{ $item['image'] ?? 'https://picsum.photos/80' }}" 
                                     class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1">{{ $item['name'] }}</h5>
                                    <p class="text-muted mb-0">₱{{ number_format($item['price'], 2) }} × {{ $item['quantity'] }}</p>
                                </div>

                                <div class="text-end">
                                    <h5 class="mb-1">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</h5>
                                    <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Total: <strong>₱{{ number_format(collect(session('cart'))->sum(fn($i) => $i['price'] * $i['quantity']), 2) }}</strong></h4>
                            
                            <form action="{{ route('order.place') }}" method="POST">
                                @csrf
                                <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    ✅ Place Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <h4>Your cart is empty</h4>
                    <a href="/" class="btn btn-primary mt-3">Browse Menu</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection