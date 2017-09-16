<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
		//si está logueado y no tiene suscripciones
		if ($request->user() && ! $request->user()->isSubscribed())
		{
			return redirect('subscription');
		}

		//si está logueado
		if ($request->user())
		{
			return redirect('home');
		}

		//en otro caso
		return $next($request);
	}
}
