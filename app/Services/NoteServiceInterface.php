<?php

namespace App\Services;

interface NoteServiceInterface
{
    public function find(int $id);

    public function create(string $content, int $noteableId, string $noteableType);

    public function update(array $data, int $id);

    public function delete(int $id);
}