@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Dashboard</h1>

    <div class="cards">
        <div class="card">
            <h3>Total Products</h3>
            <p>{{ $totalItems }}</p>
        </div>
        <div class="card">
            <h3>Low Stock</h3>
            <p>{{ $lowStock }}</p>
        </div>
        <div class="card">
            <h3>Expired Items</h3>
            <p>{{ $expired }}</p>
        </div>
    </div>
</div>
@endsection