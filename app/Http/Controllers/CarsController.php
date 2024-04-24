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
     * Store a newly created resource in storage.
     *
     * @param CarsRequest $request
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
            'car' => $car
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarsController $cars)
    {
        //
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
