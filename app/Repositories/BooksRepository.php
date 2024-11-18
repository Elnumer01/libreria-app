<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BooksRepositoryInterface;
use Illuminate\Support\Facades\DB;
class BooksRepository implements BooksRepositoryInterface
{
    public function getAll()
    {
        return DB::table('books')
        ->join("authors", "books.author_id", "=", "authors.id")
        ->select('books.*', DB::raw("CONCAT(authors.name, ' ', authors.lastname) AS author"))
        ->get();
    }

    public function getById($id)
    {
        return Book::findOrFail($id);
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update($id, array $data)
    {
        $Book = $this->getById($id);
        $Book->update($data);
        return $Book;
    }

    public function delete($id)
    {
        $Book = $this->getById($id);
        $Book->delete();
        return true;
    }
}

