<?php

use App\Http\Controllers\Identity\AuthManagementController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::controller(AuthManagementController::class)->group(function () {
        Route::post('register', 'register');
        Route::get('email-verify', 'emailVerify');
    });
});
