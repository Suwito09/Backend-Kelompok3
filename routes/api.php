<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware(['auth:api', 'check.admin'])->group(function () {
    Route::get('/admin-area', function () {
        return response()->json(['message' => 'Welcome Admin!']);
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('item', ItemController::class);
    Route::apiResource('chat' , ChatController::class);
});
