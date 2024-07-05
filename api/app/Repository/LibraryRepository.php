<?php

namespace App\Repository;

use App\Interface\LibraryRepositoryInterface;
use App\Models\Book;

class LibraryRepository implements LibraryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function all($searchTerm)
    {
        return Book::where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('author', 'like', '%' . $searchTerm . '%')
                    ->orWhere('publication_year', 'like', '%' . $searchTerm . '%')
                    ->get();
    }

    public function count()
    {
        return Book::count();
    }

    public function find(int $id)
    {
        return Book::findOrFail($id);
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update(array $data, int $id)
    {
        return Book::findOrFail($id)->update($data);
    }

    public function delete(int $id)
    {
        return Book::findOrFail($id)->delete($id);
    }
}
