<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseTrait
{
    public static function success(int $statusCode, string $message, $data, string $timeInfo): JsonResponse
    {
        return response()->json([
            'success' => true,
            'statusCode' => $statusCode,
            'message' => $message,
            'errors' => null,
            'data' => $data,
            'timeInfo' => $timeInfo
        ]);
    }
}
