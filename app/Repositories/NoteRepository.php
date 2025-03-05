<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository implements NoteRepositoryInterface
{
    public function find(int $id)
    {
        return Note::find($id);
    }

    public function create(array $data)
    {
        return Note::create($data);
    }

    public function update(array $data, int $id)
    {
        return Note::find($id)->update($data);
    }

    public function delete(int $id)
    {
        return Note::destroy($id);
    }
}