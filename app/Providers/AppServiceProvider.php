<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\CategoryInterface::class, \App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Interfaces\PaymentOptionInterface::class, \App\Repositories\PaymentOptionRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
