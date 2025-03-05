<?php

namespace App\Services;

use App\Http\Requests\UpdateContactRequest;
use App\Http\Requests\StoreContactRequest;

interface ContactServiceInterface
{
    public function showAll($company_id);

    public function show($id);

    public function create(StoreContactRequest $request);

    public function update(UpdateContactRequest $request, $id);

    public function delete($id);
}