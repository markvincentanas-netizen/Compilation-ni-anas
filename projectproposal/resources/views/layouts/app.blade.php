<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OnlineCanteen - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 260px;
            background: #2c3e50;
            color: white;
            padding-top: 20px;
        }
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }
        .nav-link {
            color: #bdc3c7 !important;
            padding: 12px 20px;
            margin: 4px 10px;
            border-radius: 8px;
        }
        .nav-link:hover, .nav-link.active {
            background: #34495e;
            color: white !important;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="px-4 mb-4">
        <h4 class="text-center">🍽️ OnlineCanteen</h4>
        <hr>
    </div>
    
    <ul class="nav flex-column">
        <li><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-3"></i> Dashboard
        </a></li>
        <li><a href="{{ route('admin.menu.index') }}" class="nav-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
            <i class="fas fa-utensils me-3"></i> Manage Menu
        </a></li>
        <li><a href="{{ route('admin.orders') }}" class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <i class="fas fa-receipt me-3"></i> Orders
        </a></li>
    </ul>

    <div class="position-absolute bottom-0 w-100 p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>

<!-- Main Content Area -->
<div class="main-content bg-light">
    <nav class="navbar navbar-dark bg-dark px-4 shadow-sm">
        <span class="navbar-brand">Admin Panel</span>
        <span>Welcome, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></span>
    </nav>

    <div class="p-4">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>