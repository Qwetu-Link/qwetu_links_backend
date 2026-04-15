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
    Route::apiResource('businesses', BusinessController::class);
    
    Route::post('/login', [AuthController::class, 'login']);

    // Route::prefix('businesses/{business}')->group(function () {
    //     Route::apiResource('users', UserController::class);
    //     Route::apiResource('staff', StaffController::class);
    //     Route::apiResource('tenants', TenantController::class);
    // });
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\v1', 'middleware' => ['auth:sanctum']], function () {
    Route::prefix('businesses/{business}')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('staff', StaffController::class);
        Route::apiResource('tenants', TenantController::class);
    });
});
