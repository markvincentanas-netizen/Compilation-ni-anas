@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Overview</h2>

    <div class="row g-4">
        <!-- Stat Cards -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow border-0 h-100 bg-primary text-white">
                <div class="card-body">
                    <i class="fas fa-shopping-bag fa-3x mb-3 opacity-75"></i>
                    <h5>Total Orders</h5>
                    <h2 class="display-5 fw-bold mb-0">{{ $totalOrders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow border-0 h-100 bg-warning text-dark">
                <div class="card-body">
                    <i class="fas fa-clock fa-3x mb-3 opacity-75"></i>
                    <h5>Pending Orders</h5>
                    <h2 class="display-5 fw-bold mb-0">{{ $pendingOrders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow border-0 h-100 bg-success text-white">
                <div class="card-body">
                    <i class="fas fa-utensils fa-3x mb-3 opacity-75"></i>
                    <h5>Menu Items</h5>
                    <h2 class="display-5 fw-bold mb-0">{{ $totalMenuItems }}</h2>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow border-0 h-100 bg-info text-white">
                <div class="card-body">
                    <i class="fas fa-users fa-3x mb-3 opacity-75"></i>
                    <h5>Today’s Sales</h5>
                    <h2 class="display-5 fw-bold mb-0">₱{{ number_format($totalOrders * 85, 0) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-5">
        <div class="col-md-6">
            <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-primary btn-lg w-100 py-4 shadow-sm">
                <i class="fas fa-plus-circle fa-2x mb-3 d-block"></i>
                Add New Menu Item
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.orders') }}" class="btn btn-outline-success btn-lg w-100 py-4 shadow-sm">
                <i class="fas fa-list fa-2x mb-3 d-block"></i>
                View All Orders
            </a>
        </div>
    </div>
</div>
@endsection