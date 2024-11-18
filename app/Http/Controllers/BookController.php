<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\BooksRepositoryInterface;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
class BookController extends Controller
{
    private $bookRepository;
    private $authorRepository;

    public function __construct(BooksRepositoryInterface $bookRepository, AuthorRepositoryInterface $authorRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
    }

    public function index()
    {
        try {
            $books = $this->bookRepository->getAll();
            $authors = $this->authorRepository->getAll();
            return view('Pages.Books',compact('books','authors'));
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

        $this->bookRepository->create($validatedData);

        return redirect('/books')->with('msg','create');
    }

    public function show($id)
    {
        try {
            $this->bookRepository->getById($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'isbn' => 'required|string',
            'gender' => 'required|string',
            'author_id' => 'required|exists:authors,id'
        ]);

        try {
            $this->bookRepository->update($id, $validatedData);
            return redirect('/books')->with('msg','update');
        } catch (\Exception $e) {
            return redirect('/books')->with('msg','error');
        }
    }


    public function destroy($id)
    {
        try {
            $this->bookRepository->delete($id);
            return redirect('/books')->with('msg','delete');
        } catch (\Exception $e) {
            return redirect('/books')->with('msg','error');
        }
    }
}
