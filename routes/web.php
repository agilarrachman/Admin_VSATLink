<?php

use App\Http\Controllers\ActivationNotaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AdminController::class, 'signin'])->name('login');
Route::post('/signin', [AdminController::class, 'authenticate']);
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::post('/signout', [AdminController::class, 'signout']);
    Route::get('/profile', [AdminController::class, 'profile']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);
    Route::get('/orders/{order}/customer', [OrderController::class, 'customerShow']);
    Route::get('/download/npwp/{order}', [OrderController::class, 'npwpDownload']);
    Route::get('/download/nib/{order}', [OrderController::class, 'nibDownload']);
    Route::get('/download/sk/{order}', [OrderController::class, 'skDownload']);
    Route::get('/orders/{order}/data', [OrderController::class, 'data']);

    Route::middleware('role:Super Admin,Sales Admin')->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/order-confirmation', [OrderController::class, 'indexConfirmation']);
        Route::get('/orders/{order}/customer/data', [OrderController::class, 'customerData']);
        Route::post('/orders/confirm', [OrderController::class, 'confirm']);
        Route::post('/orders/cancel', [OrderController::class, 'cancel']);
        Route::get('/download/invoice/{order}', [OrderController::class, 'downloadInvoice']);
    });

    Route::middleware('role:Super Admin, Logistic Admin')->group(function () {
        Route::get('/logistics/expedition', [LogisticController::class, 'indexExpedition']);
        Route::get('/logistics/pickup', [LogisticController::class, 'indexPickup']);
        Route::get('/logistics/input-sn/{order}', [LogisticController::class, 'inputSN']);
        Route::post('/logistics/store-sn/{order}', [LogisticController::class, 'storeSN']);
        Route::get('/logistics/edit-sn/{order}', [LogisticController::class, 'editSN']);
        Route::put('/logistics/update-sn/{order}', [LogisticController::class, 'updateSN']);
        Route::post('/logistics/request-pickup/{order}', [LogisticController::class, 'requestPickup']);
        Route::post('/logistics/ready-pickup/{order}', [LogisticController::class, 'readyPickup']);
        Route::post('/logistics/confirm-pickup', [LogisticController::class, 'confirmPickup']);
    });

    Route::middleware('role:Super Admin, Service Operation Admin')->group(function () {
        Route::get('/service-activations', [ActivationNotaController::class, 'index']);
        Route::get('/service-activations/provisioning', [ActivationNotaController::class, 'createProvisioning']);
        Route::post('/service-activations/provisioning', [ActivationNotaController::class, 'storeProvisioning']);
        Route::get('/service-activations/provisioning/{order}/edit', [ActivationNotaController::class, 'editProvisioning']);
        Route::get('/service-activations/technical-data', [ActivationNotaController::class, 'createTechnicalData']);
        Route::post('/service-activations/technical-data', [ActivationNotaController::class, 'storeTechnicalData']);
        Route::get('/service-activations/technical-data/{order}/edit', [ActivationNotaController::class, 'editTechnicalData']);
    });
});
