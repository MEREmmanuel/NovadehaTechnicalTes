<?php

namespace App\Repositories;

// use App\Models\User;

interface UserRepositoryInterface
{
    public function find(string $email);

    public function create(array $data);
}
