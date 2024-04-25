<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function register(AuthRequest $request): JsonResponse
    {
        $request->validated();

        $photo = $request->file('photo')->storeAs('images',
            $request->file('photo')->getClientOriginalName(), 'public');

        Users::create(array_merge($request->all(), ['photo' => $photo]));

        return response()->json([
            'message' => 'User created successfully',
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
