<?php

use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Contoh route khusus admin
Route::middleware(['auth:api', 'check.admin'])->group(function () {
    Route::get('/admin-area', function () {
        return response()->json(['message' => 'Welcome Admin!']);
    });
});
