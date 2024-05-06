<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PaymentOptionController;
use App\Http\Controllers\Admin\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', DashboardController::class)->name('admin.dashboard');

    // Category
    Route::resource('category', CategoryController::class, ['as' => 'admin']);

    // Payment Option
    Route::resource('payment-option', PaymentOptionController::class, ['as' => 'admin']);

    // Store
    Route::put('store/{id}/update-status', [StoreController::class, 'updateStatus'])->name('admin.store.update-status');
    Route::resource('store', StoreController::class, ['as' => 'admin']);
});

require __DIR__ . '/auth.php';
