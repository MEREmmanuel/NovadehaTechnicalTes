<?php

namespace App\Services;

use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;

interface CompanyServiceInterface
{
    public function showAll();

    public function show($id);

    public function create(StoreCompanyRequest $request);

    public function update(UpdateCompanyRequest $request, $id);

    public function delete($id);
}