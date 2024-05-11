<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PaymentOptionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductStockHistoryController;
use App\Http\Controllers\RequestProductController;
use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('welcome', function () {
    return view('welcome');
})->name('welcome');

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
    // Request Product (admin, seller)
    Route::post('request-product/change-status/{id}', [RequestProductController::class, 'changeStatus'])->name('admin.request-product.change-status')->middleware('role:admin');
    Route::post('request-product/import', [RequestProductController::class, 'import'])->name('admin.request-product.import')->middleware('role:admin|seller');
    Route::get('request-product/change-status-form/{id}', [RequestProductController::class, 'changeStatusForm'])->name('admin.request-product.change-status-form')->middleware('role:admin');
    Route::resource('request-product', RequestProductController::class, ['as' => 'admin'])->middleware('role:admin|seller');
    // Product
    Route::post('product/import', [ProductController::class, 'import'])->name('admin.product.import')->middleware('role:seller');
    Route::resource('product', ProductController::class, ['as' => 'admin'])->middleware('role:seller');
    // Product Stock History
    Route::post('product-stock-history/import', [ProductStockHistoryController::class, 'import'])->name('admin.product-stock-history.import')->middleware('role:seller|admin');
    Route::get('product-stock-history/download-template', [ProductStockHistoryController::class, 'downloadTemplate'])->name('admin.product-stock-history.download-template')->middleware('role:seller|admin');
    Route::resource('product-stock-history', ProductStockHistoryController::class, ['as' => 'admin'])->middleware('role:seller|admin');
    // Profile
    Route::group(['prefix' => 'profile', 'as' => 'admin.profile.'], function () {
        Route::get('/', [SettingController::class, 'profile'])->name('index');
        Route::put('update-profile', [SettingController::class, 'updateProfile'])->name('update-profile');
        Route::put('update-store', [SettingController::class, 'updateStore'])->name('update-store');
        Route::put('update-bank', [SettingController::class, 'updateBank'])->name('update-bank');
    });
});

require __DIR__ . '/auth.php';
