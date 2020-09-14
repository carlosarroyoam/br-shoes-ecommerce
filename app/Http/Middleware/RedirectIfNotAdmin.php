<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request, checks if a User is not an
     * Admin and throws a exception.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web-admin')
    {
        if (! Auth::guard($guard)->check()) {
            abort(403, 'The user doesn\'t have permition to perform this action.');
        }

        return $next($request);
    }
}
