<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyJsonRequiredMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH']) && !$request->isJson()) {
            throw new HttpClientException(
                'Only JSON format is allowed',
                Response::HTTP_BAD_REQUEST
            );
        }

        if (!$request->header('X-secret-key')) {
            throw new HttpClientException('Secret key is required', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
