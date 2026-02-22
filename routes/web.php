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
    Route::get('/customer/{order}', [OrderController::class, 'customerShow']);
    Route::get('/orders/{order}/data', [OrderController::class, 'data']);
    Route::get('/download/npwp/{order}', [OrderController::class, 'npwpDownload']);
    Route::get('/download/nib/{order}', [OrderController::class, 'nibDownload']);
    Route::get('/download/sk/{order}', [OrderController::class, 'skDownload']);

    Route::middleware('role:Super Admin,Sales Admin')->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/order-confirmation', [OrderController::class, 'indexConfirmation']);
        Route::get('/orders/{order}/customer/data', [OrderController::class, 'customerData']);
        Route::post('/orders/confirm', [OrderController::class, 'confirm']);
        Route::post('/orders/cancel', [OrderController::class, 'cancel']);
        Route::get('/download/invoice/{order}', [OrderController::class, 'downloadInvoice']);
    });

    Route::middleware('role:Super Admin, Logistic Admin')
        ->prefix('logistics')
        ->group(function () {
            Route::get('/expedition', [LogisticController::class, 'indexExpedition']);
            Route::get('/pickup', [LogisticController::class, 'indexPickup']);
            Route::get('/input-sn/{order}', [LogisticController::class, 'inputSN']);
            Route::post('/store-sn/{order}', [LogisticController::class, 'storeSN']);
            Route::get('/edit-sn/{order}', [LogisticController::class, 'editSN']);
            Route::put('/update-sn/{order}', [LogisticController::class, 'updateSN']);
            Route::post('/request-pickup/{order}', [LogisticController::class, 'requestPickup']);
            Route::post('/ready-pickup/{order}', [LogisticController::class, 'readyPickup']);
            Route::post('/confirm-pickup', [LogisticController::class, 'confirmPickup']);
        });

    Route::middleware('role:Super Admin, Service Operation Admin')
        ->prefix('service-activations')
        ->group(function () {
            Route::get('/', [ActivationNotaController::class, 'index']);
            Route::get('/detail/{nota}', [ActivationNotaController::class, 'show']);
            Route::post('/input-installation-schedule', [ActivationNotaController::class, 'inputInstallationSchedule']);
            Route::post('/edit-installation-schedule', [ActivationNotaController::class, 'editInstallationSchedule']);
            Route::get('/provisioning/{nota}', [ActivationNotaController::class, 'createProvisioning']);
            Route::post('/provisioning/{nota}', [ActivationNotaController::class, 'storeProvisioning']);
            Route::get('/provisioning/{nota}/edit', [ActivationNotaController::class, 'editProvisioning']);
            Route::put('/provisioning/{nota}', [ActivationNotaController::class, 'updateProvisioning']);
            Route::post('/technician-on-the-way/{nota}', [ActivationNotaController::class, 'technicianOnTheWay']);
            Route::post('/technician-arrived/{nota}', [ActivationNotaController::class, 'technicianArrived']);
            Route::get('/technical-data/{nota}', [ActivationNotaController::class, 'createTechnicalData']);
            Route::post('/technical-data/{nota}', [ActivationNotaController::class, 'storeTechnicalData']);
            Route::get('/technical-data/{nota}/edit', [ActivationNotaController::class, 'editTechnicalData']);
            Route::put('/technical-data/{nota}', [ActivationNotaController::class, 'updateTechnicalData']);
            Route::get('/verification/{nota}', [ActivationNotaController::class, 'createVerification']);
            Route::post('/verification/{nota}', [ActivationNotaController::class, 'storeVerification']);
            Route::get('/verification/{nota}/edit', [ActivationNotaController::class, 'editVerification']);
            Route::put('/verification/{nota}', [ActivationNotaController::class, 'updateVerification']);
            Route::get('/download/spa/{nota}', [ActivationNotaController::class, 'downloadSPA']);
        });
});
