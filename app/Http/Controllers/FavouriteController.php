<?php

use App\Models\Favourite;
use App\Models\Car;

class FavouriteController extends Controller
{
    public function getUserFavourites($user_id)
    {
        $favourites = Favourite::where('user_id', $user_id)->pluck('car_id');

        $cars = Car::whereIn('id', $favourites)->get();

        return response()->json(['getcar' => $cars]);
    }

    public function addFavourite($car_id) {
        $user_id = Auth::id();

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

    public function checkFavourite($user_id, $car_id)
    {
        $existingFavourite = Favourite::where('user_id', $user_id)->where('car_id', $car_id)->exist();

        return response()->json(['success' => $existingFavourite],);

    }

    public function removeFavourite($user_id, $car_id)
    {
        $currentfavourite = Favourite::where('user_id', $user_id)->where('car_id', $car_id)->delete();

        return response()->json(['success' => 'Favorite removed successfully']);
    }
}
