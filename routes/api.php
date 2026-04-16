<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BusinessController;
use App\Http\Controllers\Api\v1\StaffController;
use App\Http\Controllers\Api\v1\TenantController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\v1'], function () {

    Route::post('businesses', [BusinessController::class, 'store']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/verify-email', [AuthController::class, 'verify'])->name('verify.email');

});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\v1', 'middleware' => ['auth:sanctum']], function () {

    Route::apiResource('businesses', BusinessController::class)->except(['store']);

    // Table likely does have business_id
    Route::prefix('businesses/{business}')->group(function () {
        Route::apiResource('users', UserController::class);
    });

    // Table likely does NOT have business_id
    Route::prefix('businesses')->group(function () {
        Route::apiResource('staff', StaffController::class);
        Route::apiResource('tenants', TenantController::class);

        Route::post('/logout', [AuthController::class, 'logout']);

    });
});
