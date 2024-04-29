<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show($user_id): JsonResponse
    {
        try {
            $user = User::findOrFail($user_id);

            return response()->json($user);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'User not found'], 404);

        }
    }

}