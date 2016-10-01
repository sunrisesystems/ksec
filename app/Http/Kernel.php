<?php

namespace ksec\Http;

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
        \ksec\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \ksec\Http\Middleware\VerifyCsrfToken::class,
        \ksec\Http\Middleware\BeforeMiddleware::class,
        \ksec\Http\Middleware\AfterMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \ksec\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \ksec\Http\Middleware\RedirectIfAuthenticated::class,
        'sentinel' => \ksec\Http\Middleware\SentinelMiddleware::class,
        'timeout' => \ksec\Http\Middleware\SessionTimeout::class,
        'acl' => \ksec\Http\Middleware\AclMiddleware::class,
    ];
}
