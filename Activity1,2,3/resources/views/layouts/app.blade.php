<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grocery Inventory</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Grocery Admin</h2>
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('groceries.index') }}">Products</a></li>
            <li><a href="{{ route('groceries.create') }}">Add Product</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="main-content">
        @yield('content')
    </div>

</div>
</body>
</html>