<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BooksRepositoryInterface;

class BookController extends Controller
{
    private $bookRepository;

    public function __construct(BooksRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        try {
            $books = $this->bookRepository->getAll();
            return response()->json([
                'message' => 'list books',
                'books' => $books
            ],201);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'isbn' => 'required|string|max:20|unique:books,isbn',
            'gender' => 'required|string',
            'author_id' => 'required|exists:authors,id'
        ]);

        $book = $this->bookRepository->create($validatedData);

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book,
        ], 201);
    }

    public function show($id)
    {
        try {
            $book = $this->bookRepository->getById($id);
            return response()->json($book,201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'isbn' => 'required|string|max:20|unique:books,isbn',
            'gender' => 'required|string',
            'author_id' => 'required|exists:authors,id'
        ]);

        try {
            $updatedBook = $this->bookRepository->update($id, $validatedData);
            return response()->json([
                'message' => 'Book updated successfully',
                'book' => $updatedBook,
            ],201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }


    public function destroy($id)
    {
        try {
            $this->bookRepository->delete($id);
            return response()->json(['message' => 'Book deleted successfully'],201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }
}
