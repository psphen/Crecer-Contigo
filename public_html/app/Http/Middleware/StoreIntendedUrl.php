<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class StoreIntendedUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->is('login') && !$request->is('logout') && Auth::check() && !Auth::user()->isAdmin()) {
            Session::put('url.intended', $request->url());
        }


        return $next($request);
    }
}
