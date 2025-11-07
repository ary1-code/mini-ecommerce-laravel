<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web/user.php',
            __DIR__ . '/../routes/web/admin.php'
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(callback: function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function () {
            if (request()->routeIs('admin.*')) {
                return route('admin.auth.login.index');
            }

            return route('auth.login.index');
        });

        $middleware->redirectUsersTo(function () {
            if (Auth::guard('admin')->check()) {
                return route('admin.dashboard');
            }
            return route('account.profile.index');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
