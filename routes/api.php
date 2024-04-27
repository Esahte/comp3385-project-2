<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

Route::get('/v1/cars/search', [CarsController::class, 'searchMakesAndModels'])/*->middleware('auth:api')*/; // Added of my own accord
Route::get('/v1/cars', [CarsController::class, 'index'])->middleware('auth:api');
Route::post('/v1/cars', [CarsController::class, 'store'])/*->middleware('auth:api')*/;
Route::get('/v1/cars/{id}', [CarsController::class, 'show'])/*->middleware('auth:api')*/;
Route::post('/v1/cars/{id}/favourites', [CarsController::class, 'favourites'])->middleware('auth:api');
Route::delete('/v1/cars/{id}/favourites', [CarsController::class, 'unFavourite'])->middleware('auth:api'); // Added of my own accord

Route::post('/v1/auth/register', [AuthController::class, 'register']);
Route::post('/v1/auth/login', [AuthController::class, 'login']);
Route::post('/v1/auth/logout', [AuthController::class, 'logout']);

Route::get('/v1/users/{id}', [UsersController::class, 'details'])->middleware('auth:api');
Route::get('/v1/users/{id}/favourites', [UsersController::class, 'favourites'])->middleware('auth:api');

Route::get('v1/search', [SearchController::class, 'search'])/*->middleware('auth:api')*/;
