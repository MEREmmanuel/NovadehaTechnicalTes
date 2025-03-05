<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Services\NoteServiceInterface;
use OpenApi\Annotations as OA;

class NoteController extends Controller
{
    protected $noteService;

    public function __construct(NoteServiceInterface $noteService)
    {
        $this->noteService = $noteService;
    }

    public function store(StoreNoteRequest $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/notes/{id}",
     *     tags={"Notes"},
     *     security={{"bearerAuth":{}}},
     *     summary="Get a note by id",
     *     description="Returns a note by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of note to return",
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
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="noteable_id", type="integer", example=1),
     *                 @OA\Property(property="noteable_type", type="string", example="App\Models\Company"),
     *                 @OA\Property(property="content", type="string", example="This is a note")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Note not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Note not found")
     *         )
     *     )
     * )
     */

    public function show($id)
    {
        $note = $this->noteService->find($id);

        return response()->json(['status' => 'success', 'data' => $note]);
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    /**
     * @OA\Delete(
     *     path="/api/notes/{id}",
     *     tags={"Notes"},
     *     security={{"bearerAuth":{}}},
     *     summary="Delete a note",
     *     description="Deletes a note by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of note to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Note deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Note not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Note not found")
     *         )
     *     ),
     * )
     */

    public function destroy($id)
    {
        $this->noteService->delete($id);

        return response()->json(['status' => 'success', 'message' => 'Note deleted successfully']);
    }
}
