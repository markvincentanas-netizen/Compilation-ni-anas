@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            
            <!-- Receipt -->
            <div class="card shadow-lg" id="receipt">
                <div class="card-body p-5" style="background: #fff; border: 2px dashed #ddd;">

                    <div class="text-center mb-4">
                        <h2 class="fw-bold">🍽️ OnlineCanteen</h2>
                        <p class="text-muted mb-1">School Canteen Receipt</p>
                        <small class="text-muted">Order #{{ $order->order_number }}</small>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-6">
                            <strong>Customer:</strong><br>
                            {{ $order->customer_name }}
                        </div>
                        <div class="col-6 text-end">
                            <strong>Date:</strong><br>
                            {{ $order->created_at->format('M d, Y h:i A') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Order Type:</strong> 
                        <span class="badge bg-{{ $order->order_type == 'dine-in' ? 'primary' : 'info' }}">
                            {{ ucfirst($order->order_type ?? 'take-out') }}
                        </span>
                        @if($order->table_number)
                            <span class="ms-2">• Table {{ $order->table_number }}</span>
                        @endif
                    </div>

                    <hr>

                    <h6 class="mb-3">Ordered Items</h6>
                    <table class="table table-borderless">
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->quantity }}× {{ $item->menuItem->name }}</td>
                            <td class="text-end">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </table>

                    <hr>

                    <div class="d-flex justify-content-between fs-5 fw-bold">
                        <span>Total Amount</span>
                        <span>₱{{ number_format($order->total_amount, 2) }}</span>
                    </div>

                    <div class="text-center mt-5 text-muted small">
                        Thank you for ordering!<br>
                        Please present this receipt when picking up your order.
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-grid gap-3 mt-4">
                <button onclick="printReceipt()" class="btn btn-dark btn-lg">
                    🖨️ Print Receipt
                </button>
                <a href="/" class="btn btn-primary btn-lg">
                    ← Back to Menu
                </a>
            </div>

        </div>
    </div>
</div>

<script>
function printReceipt() {
    const printContents = document.getElementById('receipt').innerHTML;
    const originalContents = document.body.innerHTML;

    document.body.innerHTML = `
        <div style="max-width: 400px; margin: 20px auto; padding: 20px; font-family: Arial, sans-serif;">
            ${printContents}
        </div>
    `;

    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // Refresh to restore functionality
}
</script>
@endsection