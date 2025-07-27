<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'profile'])->middleware('auth:sanctum');
Route::post('logout', [\App\Http\Controllers\ProfileController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('admin')->group(function () {
    Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->middleware('guest');
});
Route::prefix('user')->group(function () {
    Route::post('login', [\App\Http\Controllers\User\AuthController::class, 'login'])->middleware('guest');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('posts')->controller(\App\Http\Controllers\PostController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::post('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});
