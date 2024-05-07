<?php

namespace App\Providers;

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
    }

    public function boot(): void
    {
        //
    }
}
