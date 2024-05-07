<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PaymentOptionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', DashboardController::class)->name('admin.dashboard');
    // Permission
    Route::resource('permission', PermissionController::class, ['as' => 'admin'])->middleware('role:admin');
    // Role
    Route::resource('role', RoleController::class, ['as' => 'admin'])->middleware('role:admin');
    // User
    Route::resource('user', UserController::class, ['as' => 'admin'])->middleware('role:admin');
    // Category
    Route::resource('category', CategoryController::class, ['as' => 'admin'])->middleware('role:admin');
    // Payment Option
    Route::resource('payment-option', PaymentOptionController::class, ['as' => 'admin'])->middleware('role:admin');
    // Store
    Route::put('store/{id}/update-status', [StoreController::class, 'updateStatus'])->name('admin.store.update-status')->middleware('role:admin');
    Route::resource('store', StoreController::class, ['as' => 'admin'])->middleware('role:admin');

    // Product
    Route::resource('product', ProductController::class, ['as' => 'admin'])->middleware('role:seller');
});

require __DIR__ . '/auth.php';
