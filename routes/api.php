<?php

use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::prefix('admin')->middleware(['auth:api', 'admin'])->group(function () {
    Route::apiResource('user', UserManagementController::class)->only('index', 'destroy');
});

Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::put('user', [UserManagementController::class, 'update']);
    Route::get('user', [UserManagementController::class, 'show']);
    Route::post('item/{id}/status', [ItemController::class, 'updateStatus']);
    Route::post('return/{id}', [ReturnController::class, 'store']);
    Route::post('return/{id}/status', [ReturnController::class, 'updateStatus']);
    Route::apiResource('item', ItemController::class);
    Route::apiResource('return', ReturnController::class)->except('store');
    Route::apiResource('chat' , ChatController::class);
});
