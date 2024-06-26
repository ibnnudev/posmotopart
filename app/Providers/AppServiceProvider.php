<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\CategoryInterface::class, \App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Interfaces\PaymentOptionInterface::class, \App\Repositories\PaymentOptionRepository::class);
        $this->app->bind(\App\Interfaces\StoreInterface::class, \App\Repositories\StoreRepository::class);
        $this->app->bind(\App\Interfaces\UserInterface::class, \App\Repositories\UserRepository::class);
        $this->app->bind(\App\Interfaces\RoleInterface::class, \App\Repositories\RoleRepository::class);
        $this->app->bind(\App\Interfaces\PermissionInterface::class, \App\Repositories\PermissionRepository::class);
        $this->app->bind(\App\Interfaces\ProductInterface::class, \App\Repositories\ProductRepository::class);
        $this->app->bind(\App\Interfaces\RequestProductInterface::class, \App\Repositories\RequestProductRepository::class);
        $this->app->bind(\App\Interfaces\ProductStockHistoryInterface::class, \App\Repositories\ProductStockHistoryRepository::class);
        $this->app->bind(\App\Interfaces\ProductCategoryInterface::class, \App\Repositories\ProductCategoryRepository::class);
        $this->app->bind(\App\Interfaces\ProductMerkInterface::class, \App\Repositories\ProductMerkRepository::class);
        $this->app->bind(\App\Interfaces\DiscountInterface::class, \App\Repositories\DiscountRepository::class);
        $this->app->bind(\App\Interfaces\CartInterface::class, \App\Repositories\CartRepository::class);
        $this->app->bind(\App\Interfaces\DiscountStoreInterface::class, \App\Repositories\DiscountStoreRepository::class);
        $this->app->bind(\App\Interfaces\CheckoutInterface::class, \App\Repositories\CheckoutRepository::class);
        $this->app->bind(\App\Interfaces\TransactionInterface::class, \App\Repositories\TransactionRepository::class);
        $this->app->bind(\App\Interfaces\WalletInetrface::class, \App\Repositories\WalletRepository::class);
    }

    public function boot(): void
    {
        Product::observe(\App\Observers\ProductObserver::class);
    }
}
