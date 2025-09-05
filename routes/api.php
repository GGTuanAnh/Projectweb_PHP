<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\ProductApiController;
use App\Http\Controllers\Api\V1\AuthApiController;

Route::prefix('v1')->group(function() {
    // Public
    Route::get('categories', [CategoryApiController::class, 'index']);
    Route::get('products', [ProductApiController::class, 'index']);
    Route::get('products/{product}', [ProductApiController::class, 'show']);

    // Auth
    Route::post('auth/login', [AuthApiController::class, 'login']);
    Route::post('auth/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('auth/user', [AuthApiController::class, 'user'])->middleware('auth:sanctum');
});
