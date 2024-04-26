<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);
        if ( ! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = auth()->user()->id;

        return response()->json([
            'message' => 'Login Successful!',
            'token'   => $token,
            'userId'  => $userId,
        ]);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * store a newly created resource in storage.
     *
     * @param  AuthRequest  $request
     *
     * @return JsonResponse
     */
    public function register(AuthRequest $request): JsonResponse
    {
        $request->validated();

        $photo = $request->file('photo')->storeAs('images',
            $request->file('photo')->getClientOriginalName(), 'public');

        $user = Users::create(array_merge($request->all(), ['photo' => $photo]));

        return response()->json([
            'message' => 'User created successfully',
            'userId'  => $user->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $users)
    {
        //
    }
}
