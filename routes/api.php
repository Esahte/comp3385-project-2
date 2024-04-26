<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

Route::get('/v1/cars', [CarsController::class, 'index']);
Route::post('/v1/cars', [CarsController::class, 'store']);
Route::get('/v1/cars/{id}', [CarsController::class, 'show']);
Route::post('/v1/cars/{id}/favourites', [CarsController::class, 'favourite']);
Route::get('/v1/cars/search', [CarsController::class, 'searchMakesAndModels']);

Route::post('/v1/auth/register', [AuthController::class, 'register']);

//Route::get('/v1/users/{id}', [UsersController::class, 'details']);
Route::get('/v1/users/{id}/favourites', [UsersController::class, 'favourites']);

Route::get('v1/search', [SearchController::class, 'search']);
