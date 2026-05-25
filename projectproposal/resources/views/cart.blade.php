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
                                    <h5>{{ $item['name'] }}</h5>
                                    <p class="text-muted">₱{{ number_format($item['price'], 2) }} × {{ $item['quantity'] }}</p>
                                </div>
                                <h5>₱{{ number_format($item['price'] * $item['quantity'], 2) }}</h5>
                            </div>
                        @endforeach
                    </div>

                    <div class="card-footer bg-light p-4">
                        <!-- Order Type Selection -->
                        <h5 class="mb-3">How would you like to receive your order?</h5>
                        
                        <form action="{{ route('order.place') }}" method="POST">
                            @csrf
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="order_type" id="dinein" value="dine-in" checked>
                                        <label class="form-check-label fw-bold" for="dinein">
                                            🍽️ Dine-in
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="order_type" id="takeout" value="take-out">
                                        <label class="form-check-label fw-bold" for="takeout">
                                            🛍️ Take-out
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Table Number (shown only for Dine-in) -->
                            <div id="tableSelector" class="mb-4">
                                <label class="form-label fw-bold">Table Number</label>
                                <select name="table_number" class="form-select" required>
                                    <option value="">Select Table</option>
                                    @for($i = 1; $i <= 15; $i++)
                                        <option value="Table {{ $i }}">Table {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <h4>Total: <strong>₱{{ number_format(collect(session('cart'))->sum(fn($i) => $i['price'] * $i['quantity']), 2) }}</strong></h4>
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    ✅ Place Order
                                </button>
                            </div>
                        </form>
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

<script>
    // Show/Hide Table Selector
    document.querySelectorAll('input[name="order_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'dine-in') {
                document.getElementById('tableSelector').style.display = 'block';
            } else {
                document.getElementById('tableSelector').style.display = 'none';
            }
        });
    });
</script>
@endsection