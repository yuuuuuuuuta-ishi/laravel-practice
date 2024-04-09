<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DeeplTranslator;
use App\Services\A3rt;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('A3rt', function ($app) {
            return new A3rt();
        });
        $this->app->singleton('DeeplTranslator', function ($app) {
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
