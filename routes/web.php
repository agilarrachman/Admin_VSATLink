<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('orders.index', ['management' => 'orders', 'page' => 'order-management']);
});
Route::get('/orders/order-detail', function () {
    return view('orders.order-detail', ['management' => 'orders', 'page' => 'order-management']);
});
Route::get('/orders/customer-information', function () {
    return view('orders.customer-information', ['management' => 'orders', 'page' => 'order-management']);
});
Route::get('/order-confirmation', function () {
    return view('orders.confirmation', ['management' => 'orders', 'page' => 'order-confirmation']);
});
Route::get('/sign-in', function () {
    return view('signin');
});
Route::get('/profile', function () {
    return view('profile', ['management' => 'profile', 'page' => 'profile']);
});
