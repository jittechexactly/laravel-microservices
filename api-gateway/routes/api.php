<?php

use App\Http\Controllers\Common\HealthController;
use Illuminate\Support\Facades\Route;

// Common Routes
Route::prefix('v1')->group(function () {
    Route::prefix('common')->group(function () {
        Route::get('health', HealthController::class);
    });
});
