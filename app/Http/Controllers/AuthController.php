<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\HTTP\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'message' => 'Login Successful!',
            'access_token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'location' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Handle file upload (if a photo is provided)
        $photoPath = $request->file('photo')->storeAs('photos', $request->file('photo')->getClientOriginalName(), 'public');

        // Create and save the user
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'location' => $validatedData['location'],
            'biography' => $validatedData['biography'],
            'photo' => $photoPath, 
        ]);
        $user->save();

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}




