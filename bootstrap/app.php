<?php

use App\Http\Middleware\hasInvitation;
use App\Http\Middleware\RejectBanned;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
            'hasInvitation' => hasInvitation::class,
            'setLocale' => SetLocale::class,
            'rejectBanned' => RejectBanned::class,
        ]);

        // Apply locale middleware to all web routes
        $middleware->appendToGroup('web', SetLocale::class);
        // Globally reject banned users across web routes
        $middleware->appendToGroup('web', RejectBanned::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
