<?php

namespace App\Http\Middleware;

use Closure;

class SubscriptionMiddleware
{
    //TODO Middleware for validate if user can access to Subscription
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //TODO Check if User is Subscribe else return Profile View with message
        return $request->user()->isSuscribed() ? $next($request) : redirect('profile')->with('error', 'You not can access to  this zone');
    }
}
