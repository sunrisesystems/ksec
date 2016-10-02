<?php

namespace cvmapp\Http\Middleware;

use Closure,Lib,Sentinel,App;

class AclMiddleware
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
        $user = Sentinel::getUser();
        if(!empty($user)){
            if(!Lib::isAdmin())
            {
                $hasAccess=Lib::checkModuleAccess();
                if(!$hasAccess) {   
                    App::abort(403);
                }
            }
        }else{
        }
        return $next($request);
    }
}
