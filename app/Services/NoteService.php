<?php

namespace App\Services;

use App\Repositories\NoteRepositoryInterface;
use App\Http\Exceptions\ResourceNotFoundException;

class NoteService implements NoteServiceInterface
{
    protected $noteRepository;

    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function find(int $id)
    {
        $note = $this->noteRepository->find($id);

        if (!$note) {
            throw new ResourceNotFoundException('Note not found');
        }

        return $this->noteRepository->find($id);
    }

    public function create(string $content, int $noteableId, string $noteableType)
    {
        $note = $this->noteRepository->create([
            'content' => $content,
            'noteable_id' => $noteableId,
            'noteable_type' => $noteableType,
        ]);

        return $note;
    }

    public function update(array $data, int $id)
    {
        return $this->noteRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        $note = $this->noteRepository->find($id);

        if (!$note) {
            throw new ResourceNotFoundException('Note not found');
        }
        
        return $this->noteRepository->delete($id);
    }
}