<?php

use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::prefix('admin')->middleware(['auth:api', 'check.admin'])->group(function () {
    Route::apiResource('user', UserManagementController::class)->except('update');
});

Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('item', ItemController::class);
    Route::apiResource('user', UserManagementController::class)->only('show', 'update');
    Route::apiResource('return', ReturnController::class);
    Route::apiResource('chat' , ChatController::class);
});
