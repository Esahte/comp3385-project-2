<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('/cars/search', [CarsController::class, 'searchMakesAndModels']);
    Route::get('/cars', [CarsController::class, 'index']);
    Route::post('/cars', [CarsController::class, 'store']);
    Route::get('/cars/{id}', [CarsController::class, 'show']);
    Route::get('/cars/{id}/favourites', [CarsController::class, 'isFavourite']);
    Route::post('/cars/{id}/favourites', [CarsController::class, 'favourites']);
    Route::delete('/cars/{id}/favourites', [CarsController::class, 'unFavourite']);
    Route::get('/users/{id}', [UsersController::class, 'details']);
    Route::get('/users/{id}/favourites', [UsersController::class, 'favourites']);
    Route::get('/search', [SearchController::class, 'search']);
});

Route::post('/v1/auth/register', [AuthController::class, 'register']);
Route::post('/v1/auth/login', [AuthController::class, 'login']);
Route::post('/v1/auth/logout', [AuthController::class, 'logout']);
