<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Exception;

class AuthorController extends Controller
{
    private $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index()
    {
        try {
            $authors = $this->authorRepository->getAll();
            return response()->json([
                'message'=> 'list authors',
                'authors' => $authors
            ],201);
        }
        catch (Exception $e) {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string'
        ]);

        $author = $this->authorRepository->create($data);

        return response()->json([
            'message' => 'Author created successfully',
            'author' => $author
        ],201);
    }

    public function show($id)
    {
        try {
            $author = $this->authorRepository->getById($id);
            return response()->json($author,201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string'
        ]);
        try {
            $authorUpdate = $this->authorRepository->update($id, $data);
            return response()->json([
                'message' => 'author updated successfully',
                'author' => $authorUpdate,
            ],201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->authorRepository->delete($id);
            return response()->json(['message' => 'Author deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }
}
