<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$tempDirectory = dirname(__DIR__).'/storage/framework/tmp';

if (! is_dir($tempDirectory)) {
    mkdir($tempDirectory, 0755, true);
}

// Livewire creates temporary wrappers with tmpfile(). On Windows, that function
// uses the process TEMP/TMP environment variables rather than sys_temp_dir.
putenv("TEMP={$tempDirectory}");
putenv("TMP={$tempDirectory}");
ini_set('sys_temp_dir', $tempDirectory);

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {})
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
