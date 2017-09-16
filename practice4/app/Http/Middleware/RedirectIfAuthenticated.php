<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

//TODO Modificate Auth Middleware for is Suscribed
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //TODO if User is login but hasn't got Subscription
        if($request->user() && !$request->user()->isSuscribed()){
            return redirect('/subscription');
        }

        //TODO if User is login & has got Subscription
        if ($request->user()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
