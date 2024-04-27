<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarsRequest;
use App\Models\Cars;
use App\Models\Favourites;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['cars' => Cars::all()]);
    }

    /**
     * store a newly created resource in storage.
     *
     * @param  CarsRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CarsRequest $request): JsonResponse
    {
        $request->validated();

        $photo = $request->file('photo')->storeAs('images',
            $request->file('photo')->getClientOriginalName(), 'public');

        $car = Cars::create(array_merge($request->all(), ['photo' => $photo]));

        return response()->json([
            'message' => 'Car created successfully',
            'car'     => $car
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $car
     *
     * @return JsonResponse
     */
    public function show($car): JsonResponse
    {
        return response()->json(['car' => Cars::findOrFail($car)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function searchMakesAndModels(Request $request): JsonResponse
    {
        $query = $request->input('query');

        $makes = Cars::where('make', 'like', "%{$query}%")->pluck('make');

        if ($makes->isEmpty()) {
            $models = Cars::where('model', 'like', "%{$query}%")->pluck('model');

            return response()->json(['suggestions' => $models->unique()]);
        }

        return response()->json(['suggestions' => $makes->unique()]);
    }

    /**
     * Add a car to the user's favourites.
     *
     * @param $car_id
     *
     * @return JsonResponse
     */
    public function favourites($car_id): JsonResponse
    {
        // Ensure the user is authenticated
        $user_id = auth()->id();
        if ( ! $user_id) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Create a new favourite
        Favourites::create([
            'user_id' => $user_id,
            'car_id'  => $car_id
        ]);

        return response()->json(['message' => 'Car added to favourites']);
    }

    /**
     * Remove a car from the user's favourites.
     *
     * @param $car_id
     *
     * @return JsonResponse
     */
    public function unFavourite($car_id): JsonResponse
    {
        // Ensure the user is authenticated
        $user_id = auth()->id();
        if ( ! $user_id) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Delete the favourite
        Favourites::where('user_id', $user_id)->where('car_id', $car_id)->delete();

        return response()->json(['message' => 'Car removed from favourites']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarsController $cars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarsController $cars)
    {
        //
    }
}
