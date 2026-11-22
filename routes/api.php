<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostApiController;
use App\Http\Controllers\AuthController;

// Public routes: No token required
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes: Token required
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('posts', PostApiController::class);

});
