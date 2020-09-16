<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;
use App\Actions\Jetstream\DeleteUser;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Fortify;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::loginView(function () {
            return view('pages.auth.login');
        });

        Fortify::registerView(function () {
            return view('pages.auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('pages.auth.forgot-password');
        });

        Fortify::resetPasswordView(function () {
            return view('pages.auth.reset-password');
        });

        Fortify::verifyEmailView(function () {
            return view('pages.auth.verify-email');
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
