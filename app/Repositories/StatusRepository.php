<?php

namespace App\Repositories;

use App\Models\Status;

class StatusRepository implements StatusRepositoryInterface
{

    public function create(array $data)
    {
        return Status::create($data);
    }
}