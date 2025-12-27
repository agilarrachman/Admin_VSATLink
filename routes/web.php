<?php

use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [SalesController::class, 'signin'])->name('login');
Route::post('/signin', [SalesController::class, 'authenticate']);
Route::middleware(['auth'])->group(function () {
    Route::get('/', [SalesController::class, 'index']);
    Route::post('/signout', [SalesController::class, 'signout']);
    Route::post('/profile', [SalesController::class, 'profile']);

    Route::get('/orders/show', function () {
        return view('orders.show', ['management' => 'orders', 'page' => 'order-management']);
    });
    Route::get('/orders/customer', function () {
        return view('orders.customer', ['management' => 'orders', 'page' => 'order-management']);
    });
    Route::get('/order-confirmation', function () {
        return view('orders.confirmation', ['management' => 'orders', 'page' => 'order-confirmation']);
    });
});
