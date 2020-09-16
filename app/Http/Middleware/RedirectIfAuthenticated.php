<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
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
                if(Auth::user()->userable_type === Admin::class){
                    return redirect()->route(RouteServiceProvider::HOME_ROUTE_NAME);

                if(Auth::user()->userable_type === Customer::class){
                    return redirect()->route(RouteServiceProvider::DASHBOARD_ROUTE_NAME);
                }
            }
        }

        return $next($request);
    }
}
