<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserPreferencesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::delete('/logout', [AuthController::class, 'logout'])->middleware("auth:sanctum");
});

Route::prefix("article")->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{id}', [ArticleController::class, 'show']);
})->middleware("auth:sanctum");


Route::middleware('auth:sanctum')->prefix('preferences')->group(function () {
    Route::get('/', [UserPreferencesController::class, 'index']);
    Route::post('/', [UserPreferencesController::class, 'store']);
});
