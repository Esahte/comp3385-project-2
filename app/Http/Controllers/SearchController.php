<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $make  = $request->input('make');
        $model = $request->input('model');

        // Start a query
        $query = Car::query();

        // If a make is provided, add a where clause for the make
        if ($make) {
            $query->where('make', $make);
        }

        // If a model is provided, add a where clause for the model
        if ($model) {
            $query->where('model', $model);
        }

        // Execute the query and get the results
        $cars = $query->get();

        // Return the results as a JSON response
        return response()->json(['cars' => $cars]);
    }
}
