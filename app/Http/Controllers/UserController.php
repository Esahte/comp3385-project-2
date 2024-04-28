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

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'location' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'photo' => 'nullable|string|max:255'
        ]);
    

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'location' => $request->location,
        'biography' => $request->biography,
        'photo' => $request->photo
    ]);

    return response()->json($user, 201);

}

public function update(Request $request, $user_id)
{
    try {
        $user = User::findOrFail($user_id);

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'string|min:6',
            'location' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'photo' => 'nullable|string|max:255'

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);

        }

        $user->update($request->all());

        return response()->json($user);
     } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'User not found'], 404);
     }
    }

    public function destroy($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.']);
         } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
         }
        }
    }

    
    