<?php

use App\Http\Controllers\LogisticController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [SalesController::class, 'signin'])->name('login');
Route::post('/signin', [SalesController::class, 'authenticate']);
Route::middleware(['auth'])->group(function () {
    Route::get('/', [SalesController::class, 'index']);
    Route::post('/signout', [SalesController::class, 'signout']);
    Route::post('/profile', [SalesController::class, 'profile']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);
    Route::get('/orders/{order}/customer', [OrderController::class, 'customerShow']);
    Route::get('/download/npwp/{order}', [OrderController::class, 'npwpDownload']);
    Route::get('/download/nib/{order}', [OrderController::class, 'nibDownload']);
    Route::get('/download/sk/{order}', [OrderController::class, 'skDownload']);

    Route::middleware('role:Super Admin,Sales Admin')->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/order-confirmation', [OrderController::class, 'indexConfirmation']);
        Route::get('/orders/{order}/data', [OrderController::class, 'data']);
        Route::get('/orders/{order}/customer/data', [OrderController::class, 'customerData']);
        Route::post('/orders/confirm', [OrderController::class, 'confirm']);
        Route::post('/orders/cancel', [OrderController::class, 'cancel']);
        Route::get('/download/invoice/{order}', [OrderController::class, 'downloadInvoice']);
    });

    Route::middleware('role:Super Admin, Logistic Admin')->group(function () {
        Route::get('/logistics/expedition', [LogisticController::class, 'indexExpedition']);
        Route::get('/logistics/pickup', [LogisticController::class, 'indexPickup']);
    });

    Route::middleware('role:Super Admin, Service Activation Admin')->group(function () {
        Route::get('/service-activation', function () {
            return view('service-activation.index', ['management' => 'service-activation', 'page' => 'service-activation-management']);
        });
    });
});
