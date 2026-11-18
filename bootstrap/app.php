<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return $request->is('api/*') || $request->expectsJson();
        });
    })->create();

if (is_dir('/tmp') && !is_writable(base_path('storage'))) {
    $storagePath = '/tmp/storage';
    foreach (['/framework/views', '/framework/cache/data', '/framework/sessions', '/logs'] as $dir) {
        if (!is_dir($storagePath . $dir)) {
            @mkdir($storagePath . $dir, 0777, true);
        }
    }
    $app->useStoragePath($storagePath);
}

return $app;
