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
    }

    public function boot(): void
    {
        Product::observe(\App\Observers\ProductObserver::class);
    }
}
