<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentOptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', DashboardController::class)->name('admin.dashboard');

    // Category
    Route::resource('category', CategoryController::class, ['as' => 'admin']);
    Route::resource('payment-option', PaymentOptionController::class, ['as' => 'admin']);
});

require __DIR__ . '/auth.php';
