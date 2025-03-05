<?php

namespace App\Repositories;

interface NoteRepositoryInterface
{
    public function find(int $id);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}