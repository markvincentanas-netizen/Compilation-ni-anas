@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">📦 My Orders</h2>

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <h4>You have no orders yet</h4>
            <a href="/" class="btn btn-primary">Browse Menu</a>
        </div>
    @else
        @foreach($orders as $order)
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Order #{{ $order->order_number }}</strong>
                    </div>
                    <span class="badge bg-{{ 
                        $order->status == 'pending' ? 'warning' : 
                        ($order->status == 'preparing' ? 'primary' : 
                        ($order->status == 'ready' ? 'info' : 'success')) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            <p>
                                <strong>Type:</strong> 
                                {{ ucfirst($order->order_type ?? 'take-out') }}
                                @if($order->table_number)
                                    • Table {{ $order->table_number }}
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 text-end">
                            <h5 class="text-success">₱{{ number_format($order->total_amount, 2) }}</h5>
                        </div>
                    </div>

                    <hr>

                    <h6>Items:</h6>
                    <ul class="list-group list-group-flush">
                        @foreach($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $item->quantity }}× {{ $item->menuItem->name }}</span>
                                <span>₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer bg-light">
                    <small class="text-muted">
                        Status: <strong>{{ ucfirst($order->status) }}</strong>
                    </small>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
