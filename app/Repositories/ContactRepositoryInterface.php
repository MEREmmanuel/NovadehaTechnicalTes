<?php

namespace App\Repositories;

interface ContactRepositoryInterface
{   
    public function all(int $company_id);
    
    public function find(int $id);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}