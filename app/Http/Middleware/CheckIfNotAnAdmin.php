<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfNotAnAdmin
{
    /**
     * Handle an incoming request, checks if a User is not an
     * Admin and throws a exception.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Auth::user()->is_admin) {
            abort(403, 'The user doesn\'t have permition to perform this action.');
        }

        return $next($request);
    }
}
