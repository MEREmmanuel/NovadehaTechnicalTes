<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterAuthRequest $request, AuthService $authService)
    {
        $token = $authService->register($request);

        return response()->json(['token' => $token], 200);
    }

    public function login(LoginAuthRequest $request, AuthService $authService)
    {
        $token = $authService->login($request);

        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request, AuthService $authService)
    {
        $authService->logout($request);

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
