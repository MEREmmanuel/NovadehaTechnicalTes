<?php

namespace App\Services;

use App\Http\Exceptions\ResourceNotFoundException;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Repositories\CompanyRepositoryInterface;

class CompanyService implements CompanyServiceInterface
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function showAll()
    {
        return $this->companyRepository->all();
    }

    public function show($id)
    {
        $company = $this->companyRepository->find($id);

        if(!$company) {
            throw new ResourceNotFoundException('Company not found');
        }

        return $company;
    }

    public function create(StoreCompanyRequest $request)
    {
        return $this->companyRepository->create($request->all());
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = $this->companyRepository->find($id);

        if(!$company) {
            throw new ResourceNotFoundException('Company not found');
        }

        $company = $this->companyRepository->update($request->all(), $id);

        return $company;
    }

    public function delete($id)
    {
        $company = $this->companyRepository->find($id);

        if(!$company) {
            throw new ResourceNotFoundException('Company not found');
        }

        return $this->companyRepository->delete($id);
    }
}