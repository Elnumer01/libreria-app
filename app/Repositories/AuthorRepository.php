<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
class AuthorRepository implements AuthorRepositoryInterface
{
    public function getAll()
    {
        return Author::all();
    }

    public function getById($id)
    {
        return Author::findOrFail($id);
    }

    public function create(array $data)
    {
        return Author::create($data);
    }

    public function update($id, array $data)
    {
        $author = $this->getById($id);
        $author->update($data);
        return $author;
    }

    public function delete($id)
    {
        $author = $this->getById($id);
        $author->delete();
        return true;
    }
}

