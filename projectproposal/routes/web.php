<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Dashboard Redirect
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->name('dashboard');

// Public Routes (Customer Side)
Route::get('/', [MenuController::class, 'index'])->name('home');

// Customer must login to place order (optional)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [OrderController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order-success/{id}', [OrderController::class, 'success'])->name('order.success');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/menu', [AdminController::class, 'menuIndex'])->name('menu.index');
    Route::get('/menu/create', [AdminController::class, 'menuCreate'])->name('menu.create');
    Route::post('/menu', [AdminController::class, 'menuStore'])->name('menu.store');
    Route::get('/menu/{menuItem}/edit', [AdminController::class, 'menuEdit'])->name('menu.edit');
    Route::put('/menu/{menuItem}', [AdminController::class, 'menuUpdate'])->name('menu.update');
    Route::delete('/menu/{menuItem}', [AdminController::class, 'menuDestroy'])->name('menu.destroy');
    
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::post('/orders/{order}/status', [AdminController::class, 'updateStatus'])->name('order.status');
    // Inside the auth middleware group
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');
});