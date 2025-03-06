<?php

namespace App\Services;

use App\Repositories\StatusRepositoryInterface;
use App\Http\Requests\StoreStatusRequest;

class StatusService implements StatusServiceInterface
{
    protected $statusRepository;

    public function __construct(StatusRepositoryInterface $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function create(StoreStatusRequest $request)
    {
        return $this->statusRepository->create($request->all());
    }
}