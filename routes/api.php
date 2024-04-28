<?php

use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/v1/cars/search', [CarController::class, 'searchMakesAndModels']);
    Route::get('cars', [CarController::class, 'index']);
    Route::post('cars', [CarController::class, 'store']);
    Route::get('cars/{car_id}', [CarController::class, 'show']);
    Route::delete('cars/{car_id}', [CarController::class, 'destroy']);

    Route::get('v1/search', [SearchController::class, 'search']);
});

Route::post('/v1/auth/login', [AuthController::class, 'login']);
