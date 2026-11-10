<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait ExceptionTrait
{
    public function logError(string $message, Throwable $th): void
    {
        Log::error($message, ['error' => $th->getMessage(), 'path' => $th->getFile(), 'line' => $th->getLine()]);
    }
}
