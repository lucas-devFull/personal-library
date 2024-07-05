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

    public function index(Request $request)
    {
        $search = $request->input('search');
        $books = $this->libraryService->all($search);
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
        $image = "";
        $data = $request->validate([
            'title' => 'required|string|max:144',
            'number_pages' => 'required|numeric',
            'status' => 'required|numeric',
            'actual_page' => 'numeric',
            'author' => 'string',
            'publication_year' => 'numeric',
        ]);

        if ($request->hasFile('image') && !is_null($request->file('image'))) {
            $getImage = $request->file('image');
            $image = base64_encode(file_get_contents($getImage));
        }

        $data['image'] = $image;
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
    public function updateBook(Request $request, int $id)
    {

        $image = "";
        $data = $request->validate([
            'title' => 'string|max:144',
            'number_pages' => 'numeric',
            'status' => 'numeric',
            'actual_page' => 'numeric',
            'author' => 'string',
            'publication_year' => 'numeric',
        ]);

        if ($request->hasFile('image') && !is_null($request->file('image'))) {
            $getImage = $request->file('image');
            $image = base64_encode(file_get_contents($getImage));
        }

        $data['image'] = $image;
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
