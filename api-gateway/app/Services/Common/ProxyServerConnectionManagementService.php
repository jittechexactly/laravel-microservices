<?php

namespace App\Services\Common;

use App\Traits\ExceptionTrait;
use DomainException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

abstract class ProxyServerConnectionManagementService
{
    use ExceptionTrait;

    abstract protected function service(): string;

    protected function http(): PendingRequest
    {
        $base = config('gateway.services.' . $this->service())
            ?? throw new ServiceUnavailableHttpException($this->service());

        return Http::baseUrl(rtrim($base) . '/api/v1')
            ->acceptJson()
            ->timeout(config('gateway.timeout'))
            ->retry(config('gateway.retries'), 100, throw: false)
            ->withHeaders($this->forwardedHeaders());
    }

    private function forwardedHeaders(): array
    {
        $r = request();
        return array_filter([
            'X-Correlation-Id'  => $r->header('X-Correlation-Id'),
            'X-User-Id'         => $r->header('X-User-Id'),
            'X-Organisation-Id' => $r->header('X-Organisation-Id'),
            'X-Roles'           => $r->header('X-Roles'),
        ]);
    }

    protected function send(Response $response): array
    {
        if ($response->failed()) {
            Log::info($this->service() . " service error", [$response]);
            throw new DomainException($this->service(), $response->status(), null);
        }
        return $response->json();
    }
}
