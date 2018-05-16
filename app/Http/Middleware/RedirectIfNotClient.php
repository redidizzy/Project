<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotClient
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
		if($request->user()->userable_type == 'Client' )
		{
			return $next($request);
		}
			return redirect('/home');
    }
}
