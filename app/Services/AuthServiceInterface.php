<?php

namespace App\Services;

use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function register(RegisterAuthRequest $request);

    public function login(LoginAuthRequest $request);

    public function logout(Request $request);
}