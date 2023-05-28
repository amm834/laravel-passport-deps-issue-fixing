<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function login(LoginRequest $request, Response $response)
    {
        $isAuthenticated = auth()->attempt($request->only(['email', 'password']));
        if (!$isAuthenticated) {
            return response()->json([
                'meta' => [
                    'status' => 403,
                ],
                'data' => [
                    'message' => 'Email or Password is invalid'
                ],
            ]);
        }

        $token = auth()->user()->createToken('access_token')->accessToken;
        return response()->json([
            'meta' => [
                'status' => 200
            ],
            'data' => [
                'message' => 'You was logged in successfully',
                'token' => $token
            ]
        ]);
    }
}
