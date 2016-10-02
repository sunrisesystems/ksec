<?php

namespace ksec\Http\Middleware;
use DB,Config,Session;
use Closure,Lib,Sentinel,Lang;
use Illuminate\Support\Str;
use Illuminate\Routing\Route;

class BeforeMiddleware
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
        if(Session::has('timezone')){
            $timeZone = Session::get("timezone");
            date_default_timezone_set($timeZone);
            Config::set('app.timezone',$timeZone);
        }
        DB::enableQueryLog();
        return $next($request);
    }
}
