<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Services\CompanyServiceInterface;
use App\Services\ContactServiceInterface;
use App\Services\NoteServiceInterface;

class ContactController extends Controller
{
    protected $contactService;
    protected $companyService;
    protected $noteService;

    public function __construct(ContactServiceInterface $contactService, CompanyServiceInterface $companyService, NoteServiceInterface $noteService)
    {
        $this->contactService = $contactService;
        $this->companyService = $companyService;
        $this->noteService = $noteService;
    }

    /**
     * @OA\Get(
     *     path="/api/companies/{company_id}/contacts",
     *     tags={"Contacts"},
     *     security={{"bearerAuth":{}}},
     *     summary="Get all contacts from a company",
     *     description="Returns a list of contacts associated with a company.",
     *    @OA\Parameter(
     *        name="company_id",
     *        in="path",
     *        description="Company ID",
     *        required=true,
     *        @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Empresa XYZ")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No contacts found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No contacts found.")
     *         )
     *     ),
     * )
     */

    public function index($company_id)
    {
        $company = $this->companyService->show($company_id);
        $contacts = $this->contactService->showAll($company->id);
        return response()->json(["status" => "success", "data" => $contacts], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/contacts",
     *     summary="Create a new contact",
     *     tags={"Contacts"},
     *     security={{"bearerAuth":{}}},
     *     description="Create a new contact in the system",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Contact data",
     *         @OA\JsonContent(
     *             required={"company_id", "first_name", "last_name", "position", "email", "phone"},
     *             @OA\Property(property="company_id", type="integer", example=1, description="Company ID"),
     *             @OA\Property(property="first_name", type="string", example="John", description="Contact's first name"),
     *             @OA\Property(property="last_name", type="string", example="Doe", description="Contact's last name"),
     *             @OA\Property(property="position", type="string", example="CEO", description="Contact's position in the company"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com", description="Contact's email"),
     *             @OA\Property(property="phone", type="string", example="+123456789", description="Contact's phone number"),
     *             @OA\Property(property="note", type="string", example="Additional Note", description="Additional note")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Contact created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="first_name", type="string", example="Empresa XYZ"),
     *             @OA\Property(property="email", type="string", example="contacto@empresa.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid.")
     *         )
     *     )
     * )
     */

    public function store(StoreContactRequest $request)
    {
        $contact = $this->contactService->create($request);

        if ($request->note) $this->noteService->create($request->note, $contact->id, 'App\Models\Contact');

        return response()->json(["status" => "success", "data" => $contact], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/contacts/{id}",
     *     tags={"Contacts"},
     *     security={{"bearerAuth":{}}},
     *     summary="Get a contact by id",
     *     description="Returns a contact by its id.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Contact ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Empresa XYZ")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contact not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Company not found")
     *         )
     *     ),
     * )
     */

    public function show($id)
    {
        $contact = $this->contactService->show($id);
        return response()->json(["status" => "success", "data" => $contact], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/contacts/{id}",
     *     tags={"Contacts"},
     *     security={{"bearerAuth":{}}},
     *     summary="Update a contact",
     *     description="Update a contact in the system",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Contact ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Contact data",
     *         @OA\JsonContent(
     *              required={"company_id", "first_name", "last_name", "position", "email", "phone"},
     *             @OA\Property(property="company_id", type="integer", example=1, description="ID de la empresa"),
     *             @OA\Property(property="first_name", type="string", example="John", description="Nombre del contacto"),
     *             @OA\Property(property="last_name", type="string", example="Doe", description="Apellido del contacto"),
     *             @OA\Property(property="position", type="string", example="CEO", description="Posición del contacto en la empresa"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com", description="Correo electrónico del contacto"),
     *             @OA\Property(property="phone", type="string", example="+123456789", description="Número de teléfono del contacto")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contact updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="first_name", type="string", example="Empresa XYZ"),
     *                 @OA\Property(property="email", type="string", example="contacto@empresa.com")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contact not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Contact not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email field must be a valid email address."))
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */

    public function update(UpdateContactRequest $request, $id)
    {
        $contact = $this->contactService->update($request, $id);
        return response()->json(["status" => "success", "data" => $contact], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/contacts/{id}",
     *     tags={"Contacts"},
     *     security={{"bearerAuth":{}}},
     *     summary="Delete a contact",
     *     description="Delete a contact from the system",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Contact ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Contact deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Company not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Contact not found")
     *         )
     *     ),
     * )
     */

    public function destroy($id)
    {
        $this->contactService->delete($id);
        return response()->json(["status" => "success", "data" => "Contact deleted successfully"], 204);
    }
}
