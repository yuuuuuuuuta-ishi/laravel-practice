<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DeeplTranslator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DeeplTranslator::class, function ($app) {
            return new DeeplTranslator();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
