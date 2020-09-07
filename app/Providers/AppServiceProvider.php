<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\ProductService', function ($app) {
            return new \App\Services\ProductService();
        });

        $this->app->singleton('App\Services\ProductVariantService', function ($app) {
            return new \App\Services\ProductVariantService();
        });

        $this->app->singleton('App\Services\ProductPropertyTypeService', function ($app) {
            return new \App\Services\ProductPropertyTypeService();
        });

        $this->app->singleton('App\Services\ProductPropertyService', function ($app) {
            return new \App\Services\ProductPropertyService();
        });

        $this->app->singleton('App\Services\ProductService', function ($app) {
            return new \App\Services\ProductService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
