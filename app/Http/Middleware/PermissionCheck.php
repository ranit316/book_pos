<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Throwable;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (isAutherized(Route::currentRouteName())) {

            return $next($request);
        } elseif (Route::currentRouteName() == "dashboard.show") {
            return $next($request);
        } else {
            // return back();
            abort(403, "You don't have enough access for this URL");
        }
    }
}
