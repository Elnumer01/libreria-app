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
            return view('Pages.Authors',compact('authors'));
        }
        catch (Exception $e) {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
        ]);

        $this->authorRepository->create($data);

        return redirect('/authors')->with('msg','create');
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
            'lastname' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
        ]);
        try {
            $this->authorRepository->update($id, $data);
            return redirect('/authors')->with('msg','update');
        } catch (Exception $e) {
            return redirect('/authors')->with('msg','error');
        }
    }

    public function destroy($id)
    {
        try {
            $this->authorRepository->delete($id);
            return redirect('/authors')->with('msg','delete');
        } catch (Exception $e) {
            return redirect('/authors')->with('msg','error');
        }
    }
}
