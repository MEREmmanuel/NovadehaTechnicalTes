<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterAuthRequest $request)
    {
        $token = $this->authService->register($request);

        return response()->json(['token' => $token], 200);
    }

    public function login(LoginAuthRequest $request)
    {
        $token = $this->authService->login($request);

        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
