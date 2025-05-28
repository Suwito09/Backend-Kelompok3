<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\UserController;

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

// User routes
Route::get('user', [UserController::class, 'index']);
Route::get('user/{id}', [UserController::class, 'show']);
Route::post('user', [UserController::class, 'store']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

