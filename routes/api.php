<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

// Define the login route outside the middleware group
Route::post('v1/auth/login', [AuthController::class, 'login']);
Route::post('v1/auth/register', [AuthController::class, 'register']);
Route::post('v1/auth/logout', [AuthController::class, 'logout']);

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('cars/search', [CarController::class, 'searchMakesAndModels']);
    Route::get('cars', [CarController::class, 'index']);
    Route::post('cars', [CarController::class, 'store']);
    Route::get('cars/{car_id}', [CarController::class, 'show']);
    Route::delete('cars/{car_id}', [CarController::class, 'destroy']);

    // Removed the login route from here

    Route::get('search', [SearchController::class, 'search']);
});
