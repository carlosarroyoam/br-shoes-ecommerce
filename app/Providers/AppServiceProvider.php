<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Customer;
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
        //
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
}
