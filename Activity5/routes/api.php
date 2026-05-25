<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/test', function () {
    return 'API OK';
});

Route::get('/users', [UserController::class, 'index']);