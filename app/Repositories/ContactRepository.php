<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function all(int $company_id)
    {
        return Contact::where('company_id', $company_id)->get();
    }
    
    public function find(int $id)
    {
        return Contact::find($id);
    }

    public function create(array $data)
    {
        return Contact::create($data);
    }

    public function update(array $data, int $id)
    {
        return Contact::find($id)->update($data);
    }

    public function delete(int $id)
    {
        return Contact::destroy($id);
    }
}