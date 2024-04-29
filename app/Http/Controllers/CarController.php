<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * Display a listing of the cars.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $cars = Car::all();
        return response()->json(['message' => 'Cars retrieved successfully', 'data' => $cars]);
    }

    /**
     * Store a newly created car in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

    // dd($request->all());
    // Validate the request data
    $validatedData = $request->validate([
        'description' => 'required|string',
        'make' => 'required|string',
        'model' => 'required|string',
        'colour' => 'required|string',
        'year' => 'required|string',
        'transmission' => 'required|string',
        'car_type' => 'required|string',
        'price' => 'required|numeric',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        'user_id' => 'required|integer',
    ]);

    // dd($validatedData);

    // Retrieve validated data
    $description = $validatedData['description'];
    $make = $validatedData['make'];
    $model = $validatedData['model'];
    $colour = $validatedData['colour'];
    $year = $validatedData['year'];
    $transmission = $validatedData['transmission'];
    $car_type = $validatedData['car_type'];
    $price = $validatedData['price'];
    $photo = $validatedData['photo'];
    $user_id = $validatedData['user_id'];

    // Create a new Car instance and assign properties
    $car = new Car();
    $car->description = $description;
    $car->make = $make;
    $car->model = $model;
    $car->colour = $colour;
    $car->year = $year;
    $car->transmission = $transmission;
    $car->car_type = $car_type;
    $car->price = $price;

    // Handle photo upload
    if ($request->hasFile('photo')) {
        $photoFile = $request->file('photo');
        $photoFileName = $make . '_' . $model . '_' . time() . '.' . $photoFile->getClientOriginalExtension();
        $photoFile->storeAs('car_photos', $photoFileName, 'public');
        $car->photo = $photoFileName;
    } else {
        // If a photo is not uploaded
        $car->photo = null;
    }

    $car->user_id = $user_id;

    // Save the Car instance to the database
    $car->save();

    return response()->json(['message' => 'Car created successfully', 'data' => $car], 201);
    }

    /**
     * Display the specified car.
     *
     * @param  int  $car_id
     *
     * @return JsonResponse
     */
    public function show(int $car_id): JsonResponse
    { 
        $car = Car::find($car_id);
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        return response()->json(['message' => 'Car retrieved successfully', 'car' => $car]);
    }

    /**
     * Remove the specified car from storage.
     *
     * @param  int  $car_id
     *
     * @return JsonResponse
     */
    public function destroy(int $car_id): JsonResponse
    {
        $car = Car::find($car_id);
       
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        $car->delete();
        return response()->json(['message' => 'Car deleted successfully']);
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

        $makes = Car::whereRaw('LOWER(make) LIKE ?', [strtolower("%{$query}%")])->pluck('make');

        if ($makes->isEmpty()) {
            $models = Car::whereRaw('LOWER(model) LIKE ?', [strtolower("%{$query}%")])->pluck('model');

            return response()->json(['suggestions' => $models->unique()]);
        }

        return response()->json(['suggestions' => $makes->unique()]);
    }
}
