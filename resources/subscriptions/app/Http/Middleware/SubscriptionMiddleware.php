<?php

namespace App\Http\Middleware;

use Closure;

class SubscriptionMiddleware
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
	    if( ! $request->user()->isSubscribed())
	    {
		    return redirect('profile')->with('error', 'No puedes acceder a esa zona');
	    }
	    return $next($request);
    }
}
