<?php

use App\Http\Middleware\AdminUPQ;
use App\Http\Middleware\AdminUPZ;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'AdminUPZ' => AdminUPZ::class,
            'AdminUPQ' => AdminUPQ::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();