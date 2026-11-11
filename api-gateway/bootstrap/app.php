<?php

use App\Http\Middleware\OnlyJsonRequiredMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
        $middleware->api([
            OnlyJsonRequiredMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (DomainException $e, Request $request) {
            $status = ($e->getCode() >= 400 && $e->getCode() < 600) ? $e->getCode() : 502;

            return response()->json([
                'success'    => false,
                'statusCode' => $status,
                'message'    => $e->getMessage(),
                'errors'     => null,
                'data'       => null,
                'timeInfo'   => now()->toDateTimeString(),
            ], $status);
        });
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'success'    => false,
                'statusCode' => $e->status,
                'message'    => 'Validation failed.',
                'errors'     => $e->errors(),
                'data'       => null,
                'timeInfo'   => now()->toDateTimeString(),
            ], $e->status);
        });

        $exceptions->render(function (Exception $e, Request $request) {
            $status = ($e->getCode() >= 400 && $e->getCode() < 600) ? $e->getCode() : 502;

            return response()->json([
                'success'    => false,
                'statusCode' => $status,
                'message'    => $e->getMessage(),
                'errors'     => null,
                'data'       => null,
                'timeInfo'   => now()->toDateTimeString(),
            ], $status);
        });
    })->create();
