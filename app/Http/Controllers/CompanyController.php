<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Services\CompanyServiceInterface;
use App\Services\NoteServiceInterface;
use OpenApi\Annotations as OA;

class CompanyController extends Controller
{
    protected $companyService;
    protected $noteService;

    public function __construct(CompanyServiceInterface $companyService, NoteServiceInterface $noteService)
    {
        $this->companyService = $companyService;
        $this->noteService = $noteService;
    }

    /**
     * @OA\Get(
     *     path="/api/companies",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *     summary="Get all companies",
     *     description="Returns all companies",
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
     *         description="Companies not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No companies found")
     *         )
     *     ),
     * )
     */

    public function index()
    {
        $companies = $this->companyService->showAll();

        return response()->json(["status" => "success", "data" => $companies], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/companies/{id}",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *     summary="Get company by id",
     *     description="Returns a company by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Company id",
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
     *         description="Company not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Company not found")
     *         )
     *     ),
     * )
     */

    public function show($id)
    {
        $company = $this->companyService->show($id);

        return response()->json(["status" => "success", "data" => $company], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/companies",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *     summary="Create a company",
     *     description="Create a new company with the provided data.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Company data",
     *         @OA\JsonContent(
     *             required={"name", "address", "city", "state", "zipcode", "country", "email", "phone"},
     *             @OA\Property(property="name", type="string", example="Empresa XYZ"),
     *             @OA\Property(property="address", type="string", example="123 Calle Principal"),
     *             @OA\Property(property="city", type="string", example="Ciudad Ejemplo"),
     *             @OA\Property(property="state", type="string", example="Estado Ejemplo"),
     *             @OA\Property(property="zipcode", type="string", example="12345"),
     *             @OA\Property(property="country", type="string", example="México"),
     *             @OA\Property(property="website", type="string", nullable=true, example="https://www.empresa.com"),
     *             @OA\Property(property="note", type="string", nullable=true, example="Nota de la empresa"),
     *             @OA\Property(property="email", type="string", format="email", example="contacto@empresa.com"),
     *             @OA\Property(property="phone", type="string", example="+52 123 456 7890")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Company created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Empresa XYZ"),
     *             @OA\Property(property="email", type="string", example="contacto@empresa.com")
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
     *                 @OA\Property(property="name", type="array", @OA\Items(type="string", example="The name field is required."))
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

    public function store(StoreCompanyRequest $request)
    {
        $company = $this->companyService->create($request);

        if ($request->note) $this->noteService->create($request->note, $company->id, 'App\Models\Company');

        return response()->json(["status" => "success", "data" => $company], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/companies/{id}",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *     summary="Update a company",
     *     description="Update an existing company with the provided data.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Company ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Company data",
     *         @OA\JsonContent(
     *             required={"name", "address", "city", "state", "zipcode", "country", "email", "phone"},
     *             @OA\Property(property="name", type="string", example="Empresa XYZ"),
     *             @OA\Property(property="address", type="string", example="123 Calle Principal"),
     *             @OA\Property(property="city", type="string", example="Ciudad Ejemplo"),
     *             @OA\Property(property="state", type="string", example="Estado Ejemplo"),
     *             @OA\Property(property="zipcode", type="string", example="12345"),
     *             @OA\Property(property="country", type="string", example="México"),
     *             @OA\Property(property="website", type="string", nullable=true, example="https://www.empresa.com"),
     *             @OA\Property(property="note", type="string", nullable=true, example="Nota de la empresa"),
     *             @OA\Property(property="email", type="string", format="email", example="contacto@empresa.com"),
     *             @OA\Property(property="phone", type="string", example="+52 123 456 7890")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Company updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Empresa XYZ"),
     *                 @OA\Property(property="email", type="string", example="contacto@empresa.com")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Company not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Company not found")
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

    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = $this->companyService->update($request, $id);

        return response()->json(["status" => "success", "data" => $company], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/companies/{id}",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *     summary="Delete a company",
     *     description="Delete a company",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Company id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Company deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Company not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Company not found")
     *         )
     *     ),
     * )
     */

    public function destroy($id)
    {
        $this->companyService->delete($id);

        return response()->json(["status" => "success", "data" => null], 204);
    }
}
