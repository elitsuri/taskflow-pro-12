<?php

use App\Http\Controllers\Api\ItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', fn($req) => auth()->attempt($req->only('email', 'password')));
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('items', ItemController::class);
    });
});
