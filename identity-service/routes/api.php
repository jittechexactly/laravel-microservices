<?php

use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::controller(RegistrationController::class)->group(function () {
        Route::post('register', 'registerUser');
    });
});
