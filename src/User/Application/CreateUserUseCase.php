<?php

namespace Src\User\Application;

class CreateUserUseCase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request): void
    {
        $user = new User(
            $request->name,
            $request->email,
            $request->password
        );

        $this->userRepository->save($user);
    }
}
