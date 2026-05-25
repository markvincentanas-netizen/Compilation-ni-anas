@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📋 All Orders</h1>

    @forelse($orders as $order)
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between bg-light">
                <div>
                    <strong>#{{ $order->order_number }}</strong> 
                    <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'preparing' ? 'primary' : 'success') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div>
                    <strong>₱{{ number_format($order->total_amount, 2) }}</strong>
                </div>
            </div>
            
            <div class="card-body">
                <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
                <p>
                    <strong>Order Type:</strong> 
                    <span class="badge bg-info">{{ ucfirst($order->order_type ?? 'take-out') }}</span>
                    @if($order->table_number)
                        | <strong>Table:</strong> {{ $order->table_number }}
                    @endif
                </p>

                <h6>Items:</h6>
                <ul class="list-group list-group-flush mb-3">
                    @foreach($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $item->quantity }}× {{ $item->menuItem->name }}</span>
                            <span>₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                        </li>
                    @endforeach
                </ul>

                <!-- Status Update Form -->
                <form action="{{ route('admin.order.status', $order) }}" method="POST" class="d-flex gap-3 align-items-end">
                    @csrf
                    <div class="flex-grow-1">
                        <label class="form-label">Change Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                            <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready for Pickup</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sync"></i> Update
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center py-5">
            No orders yet.
        </div>
    @endforelse
</div>
@endsection