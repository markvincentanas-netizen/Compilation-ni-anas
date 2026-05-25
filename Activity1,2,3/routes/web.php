<?php

use App\Http\Controllers\GroceryController;
use Illuminate\Support\Facades\Route;

// Dashboard route
Route::get('/', [GroceryController::class, 'dashboard'])->name('dashboard');

// Grocery CRUD routes
Route::resource('groceries', GroceryController::class);