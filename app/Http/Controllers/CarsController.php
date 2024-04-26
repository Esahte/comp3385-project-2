<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarsRequest;
use App\Models\Cars;
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
     * @return JsonResponse
     */
    public function show($car): JsonResponse
    {
        return response()->json(['car' => Cars::findOrFail($car)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchMakesAndModels(Request $request): JsonResponse
    {
        $query = $request->input('query');

        $makes  = Cars::where('make', 'like', "%{$query}%")->pluck('make');
        $models = Cars::where('model', 'like', "%{$query}%")->pluck('model');

        return response()->json(['suggestions' => $makes->concat($models)->unique()]);
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
