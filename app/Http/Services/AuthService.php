<?php

namespace App\Http\Services;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService
{
    /**
     * Register a new user.
     *
     * @param array<string, string> $data
     * @return \App\Models\User
     */
    public function register(RegisterAuthRequest $request): string
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $user->createToken('auth_token')->accessToken;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param array<string, string> $data
     * @return string
     */
    public function login(LoginAuthRequest $request): string
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $user->createToken('auth_token')->accessToken;
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return void
     */
    public function logout(Request $request): void
    {
        $request->user()->token()->revoke();
    }
}