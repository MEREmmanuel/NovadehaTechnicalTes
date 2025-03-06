<?php

namespace App\Services;

use App\Http\Requests\StoreStatusRequest;

interface StatusServiceInterface
{
    public function create(StoreStatusRequest $request);
}