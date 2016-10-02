<?php

namespace cvmapp\Http\Middleware;

use Closure;
use Sentinel,App;

class SentinelMiddleware
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
        
        if (Sentinel::guest())
        {
            // User is not logged in
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {

                return redirect()->guest('/');
            }
        }
        return $next($request);
    }
}
