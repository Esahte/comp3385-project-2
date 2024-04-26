<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Favourites;
use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $user_id
     * @return JsonResponse
     */
    public function details(int $user_id): JsonResponse
    {
        return response()->json(['user' => Users::findOrFail($user_id)]);
    }

    /**
     * store a newly created resource in storage.
     *
     * @param int $user_id
     * @return JsonResponse
     */
    public function favourites(int $user_id): JsonResponse
    {
        $car_ids = Favourites::findOrFail($user_id)->pluck('car_id');

        return response()->json(['favourites' => Cars::whereIn('id', $car_ids)->get()]);
    }
}
