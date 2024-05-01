<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class FavouriteController extends Controller
{
    /**
     * Get all the cars that a user has favourited
     *
     * @param $user_id
     * @return JsonResponse
     */
    public function getUserFavourites($user_id): JsonResponse
    {
        $favourites = Favourite::where('user_id', $user_id)->pluck('car_id');

        $cars = Car::whereIn('id', $favourites)->get();

        return response()->json(['getCar' => $cars]);
    }

    /**
     * Add a car to the user's favourites
     *
     * @param $car_id
     * @return JsonResponse
     */
    public function addFavourite($car_id): JsonResponse
    {
        $user_id = auth()->id();

        if (!$user_id) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $existingFavourite = Favourite::where('user_id', $user_id)->where('car_id', $car_id)->first();

        if ($existingFavourite) {
            return response()->json(['message' => 'This car is already in your favourites']);
        }

        $favourite = new Favourite;
        $favourite->user_id = $user_id;
        $favourite->car_id = $car_id;
        $favourite->save();

        return response()->json(['message' => 'Car added to favourites']);
    }

    /**
     * Check if a car is in the user's favourites
     *
     * @param $user_id
     * @param $car_id
     * @return JsonResponse
     */
    public function checkFavourite($car_id): JsonResponse
    {
        $existingFavourite = Favourite::where('user_id', auth()->id())->where('car_id', $car_id)->exists();

        return response()->json(['success' => $existingFavourite],);

    }

    /**
     * Remove a car from the user's favourites
     *
     * @param $user_id
     * @param $car_id
     * @return JsonResponse
     */
    public function removeFavourite($car_id): JsonResponse
    {
        Favourite::where('user_id', auth()->id())->where('car_id', $car_id)->delete();

        return response()->json(['success' => 'Favorite removed successfully']);
    }
}
