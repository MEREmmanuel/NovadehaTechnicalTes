<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusRequest;
use App\Services\StatusServiceInterface;

class StatusController extends Controller
{
    protected $statusService;

    public function __construct(StatusServiceInterface $statusService)
    {
        $this->statusService = $statusService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreStatusRequest $request)
    {
        $status = $this->statusService->create($request);

        return response()->json(['status' => 'sucess', 'data' => $status]);
    }

}
