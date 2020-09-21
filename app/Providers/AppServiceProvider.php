<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

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
        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->userable_type === Admin::class;
        });

        Blade::if('customer', function () {
            return Auth::check() && Auth::user()->userable_type === Customer::class;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function providesasd()
    {
        return [
            ProductService::class,
            ProductVariantService::class,
            ProductPropertyTypeService::class,
            ProductPropertyService::class,
            ProductService::class,
        ];
    }
}
