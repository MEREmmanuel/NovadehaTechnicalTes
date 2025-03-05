<?php

namespace App\Services;

use App\Http\Exceptions\ResourceNotFoundException;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;

class AuthService implements AuthServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * Register a new user.
     *
     * @param array<string, string> $data
     * @return \App\Models\User
     */
    public function register(RegisterAuthRequest $request): string
    {
        $user = $this->userRepository->create($request->all());

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
        $user = $this->userRepository->find($request->email);

        if (!$user) {
            throw new ResourceNotFoundException('User not found');
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