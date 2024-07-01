<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\LibraryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        protected LibraryService $libraryService
    )
    {
    }

    public function index()
    {
        $books = $this->libraryService->all();
        return response()->json([
            'success' => true,
            'data' => $books,
            'message' => 'All books retrivied'
        ], Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:144',
            'status' => 'required|numeric',
        ]);

        $book = $this->libraryService->create($data);
        return response()->json([
            'success' => true,
            'data' => $book,
            'message' => 'Book created'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $book = $this->libraryService->find($id);
        return response()->json([
            'success' => true,
            'data' => $book,
            'message' => 'Book'
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
         $data = $request->validate([
            'name' => 'required|string|max:144',
            'status' => 'required|numeric',
        ]);

        $book = $this->libraryService->update($data, $id);
        return response()->json([
            'success' => true,
            'data' => $book,
            'message' => 'Book updated'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->libraryService->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Book Deleted'
        ], Response::HTTP_OK);
    }
}
