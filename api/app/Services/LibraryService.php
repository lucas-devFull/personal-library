<?php

namespace App\Services;

use App\Interface\LibraryRepositoryInterface;

class LibraryService
{
    public function __construct(
        protected LibraryRepositoryInterface $libraryRepository
    )
    {
    }

    public function all($searchTerm)
    {
        return $this->libraryRepository->all($searchTerm);
    }

    function count() {
        return $this->libraryRepository->count();
    }

    public function create(array $data)
    {
        $this->libraryRepository->create($data);
    }

    public function find(int $id)
    {
        return $this->libraryRepository->find($id);
    }

    public function update(array $data, int $id)
    {
        return $this->libraryRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->libraryRepository->delete($id);
    }
}
