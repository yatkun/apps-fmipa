<?php

use App\Http\Middleware\Auth;
use App\Http\Middleware\Guest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.key' => \App\Http\Middleware\CheckAuthenticatedApplication::class,
            'auth.iku' => \App\Http\Middleware\Iku::class,
            'auth.dokumen' => \App\Http\Middleware\Dokumen::class,
            'auth.admin' => \App\Http\Middleware\Admin::class,
            'tendik' => \App\Http\Middleware\IsTendik::class,
            'dosen' => \App\Http\Middleware\IsDosen::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
