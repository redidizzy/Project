<?php

namespace App\Http\Middleware;

use Closure;

class VerifierUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$typeUser)
    {
		if($request->user()->userable_type != $typeUser )
		{	
			return redirect('/home');
        }
		return $next($request);
    }
}
