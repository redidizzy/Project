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
    public function handle($request, Closure $next,$typeUser, $typeUser2 = null)
    {
		if($request->user()->userable_type == $typeUser or ($typeUser2 != null and $request->user()->userable_type == $typeUser2))
		{	
			return $next($request);
        }
		return redirect('/home');
    }
}
