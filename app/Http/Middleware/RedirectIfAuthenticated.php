<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->userable_type === Admin::class) {
                    return redirect()->route(RouteServiceProvider::DASHBOARD_ROUTE_NAME);
                }

                return redirect()->route(RouteServiceProvider::HOME_ROUTE_NAME);
            }
        }

        return $next($request);
    }
}
