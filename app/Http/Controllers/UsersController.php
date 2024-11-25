<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Repositories\Interfaces\UsersRepositoryInterface;
use Exception;

class UsersController extends Controller
{
    private $usersRepository;


    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = $this->usersRepository->getAll();
            $roles = Rol::all();
            return view('Pages.Users',compact('users','roles'));
        }
        catch(Exception $e){
            return response()->json(['message' => 'users not found'], 404);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'rol_id' => 'required',
        ]);

        $validatedData['password'] = bcrypt('12345678');

        $this->usersRepository->create($validatedData);

        return redirect('/users')->with('msg','create');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $this->usersRepository->getById($id);
        } catch (Exception $e) {
            return response()->json(['message' => 'Users not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'rol_id' => 'required',
                'password' => 'required|min:8'
            ]);

            $this->usersRepository->update($id, $validatedData);
            return redirect('/users')->with('msg','update');

        }
        catch(Exception $e){
            return redirect('/users')->with('msg','error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->usersRepository->delete($id);
            return redirect('/users')->with('msg','delete');
        } catch (Exception $e) {
            return redirect('/users')->with('msg','error');
        }
    }
}
