<?php

namespace cvmapp\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \cvmapp\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \cvmapp\Http\Middleware\VerifyCsrfToken::class,
        \cvmapp\Http\Middleware\BeforeMiddleware::class,
        \cvmapp\Http\Middleware\AfterMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \cvmapp\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \cvmapp\Http\Middleware\RedirectIfAuthenticated::class,
        'sentinel' => \cvmapp\Http\Middleware\SentinelMiddleware::class,
        'timeout' => \cvmapp\Http\Middleware\SessionTimeout::class,
        'acl' => \cvmapp\Http\Middleware\AclMiddleware::class,
    ];
}
