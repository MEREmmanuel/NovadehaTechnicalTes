<?php

namespace App\Services;

use App\Repositories\ContactRepositoryInterface;
use App\Http\Exceptions\ResourceNotFoundException;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactService implements ContactServiceInterface
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function showAll($company_id)
    {
        return $this->contactRepository->all($company_id);
    }

    public function show($id)
    {
        $contact = $this->contactRepository->find($id);

        if(!$contact) {
            throw new ResourceNotFoundException('Contact not found');
        }

        return $contact;
    }

    public function create(StoreContactRequest $request)
    {
        return $this->contactRepository->create($request->all());
    }

    public function update(UpdateContactRequest $request, $id)
    {
        $contact = $this->contactRepository->find($id);

        if(!$contact) {
            throw new ResourceNotFoundException('Contact not found');
        }

        $contact = $this->contactRepository->update($request->all(), $id);

        return $contact;
    }

    public function delete($id)
    {
        $contact = $this->contactRepository->find($id);

        if(!$contact) {
            throw new ResourceNotFoundException('Contact not found');
        }

        return $this->contactRepository->delete($id);
    }
}