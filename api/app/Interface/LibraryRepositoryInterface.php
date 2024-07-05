<?php

namespace App\Interface;

interface LibraryRepositoryInterface
{
    public function all(string $searchTerm);
    public function find( int $id);
    public function create( array $data );
    public function update( array $data, int $id);
    public function delete( int $id);
}
