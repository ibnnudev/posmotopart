<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\CategoryInterface::class, \App\Repositories\CategoryRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
