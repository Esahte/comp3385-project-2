<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function show($user_id)
    {
        try {
            $user = User::findOrFail($user_id);

            return response()->json($user);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'User not found'], 404);

        }
    }
}
    
    