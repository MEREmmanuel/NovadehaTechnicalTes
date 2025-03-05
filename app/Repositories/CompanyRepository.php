<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function all()
    {
        return Company::with('note')->get();
    }

    public function find(int $id)
    {
        return Company::with('note')->find($id);
    }

    public function create(array $data)
    {
        return Company::create($data);
    }

    public function update(array $data, int $id)
    {
        return Company::find($id)->update($data);
    }

    public function delete(int $id)
    {
        return Company::find($id)->delete();
    }
}