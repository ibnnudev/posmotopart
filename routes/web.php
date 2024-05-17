<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController as AdminDiscountController;
use App\Http\Controllers\Admin\PaymentOptionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductMerkController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DiscountStoreController;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\ProductController as GuestProductController;
use App\Http\Controllers\Guest\StoreController as GuestStoreController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductStockHistoryController;
use App\Http\Controllers\RequestProductController;
use App\Http\Controllers\Seller\DiscountStoreController as SellerDiscountStoreController;
use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Store
Route::get('store/show/{slug}', [GuestStoreController::class, 'show'])->name('store.show');

// Product By Category
Route::group(['prefix' => 'product-category'], function () {
    Route::get('/', [GuestProductController::class, 'index'])->name('product-category.index');
    Route::get('show/{categoryId}/{storeId}', [GuestProductController::class, 'show'])->name('product-category.show');
    Route::get('products/{product_merk_id}', [GuestProductController::class, 'products'])->name('product-category.products');
});

// Cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'add'])->name('cart.add');
    Route::post('update', [CartController::class, 'update'])->name('cart.update');
    Route::post('delete', [CartController::class, 'delete'])->name('cart.delete');
    Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');

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
    // Product Category
    Route::resource('product-category', ProductCategoryController::class, ['as' => 'admin'])->middleware('role:seller|admin');
    // Product Merks
    Route::resource('product-merk', ProductMerkController::class, ['as' => 'admin'])->middleware('role:seller|admin');
    // Campaign
    Route::resource('discount', AdminDiscountController::class, ['as' => 'admin'])->middleware('role:admin|seller');
    Route::group(['prefix' => 'discoun-store', 'as' => 'admin.discount-store.'], function () {
        Route::get('/', [SellerDiscountStoreController::class, 'index'])->name('index')->middleware('role:seller');
        Route::post('{id}/apply', [SellerDiscountStoreController::class, 'store'])->name('apply')->middleware('role:seller');
        Route::post('{id}/remove', [SellerDiscountStoreController::class, 'destroy'])->name('remove')->middleware('role:seller');
    });
});

require __DIR__ . '/auth.php';
