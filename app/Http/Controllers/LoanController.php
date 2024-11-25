<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\LoanRepositoryInterface;
use App\Repositories\Interfaces\BooksRepositoryInterface;
use App\Repositories\Interfaces\UsersRepositoryInterface;

class LoanController extends Controller
{
    private $usersRepository;
    private $bookRepository;
    private $loanRepository;

    public function __construct(LoanRepositoryInterface $loanRepository, BooksRepositoryInterface $bookRepository, UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->bookRepository = $bookRepository;
        $this->loanRepository = $loanRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $clients = $this->usersRepository->getClients();
            $books = $this->bookRepository->getAll();
            $loans = $this->loanRepository->getAll();
            return view('Pages.Loans',compact('clients','books','loans'));
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Loans not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($this->loanRepository->BookExist($request->book_id)){
            return redirect('/loans')->with('msg','exists');
        }

        $validatedData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
        ]);

        $validatedData['status'] = 'Prestado';

        $this->loanRepository->create($validatedData);

        return redirect('/loans')->with('msg','create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $this->loanRepository->getById($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'book_id' => 'required',
                'status' => 'required'
            ]);
            $this->loanRepository->update($id, $validatedData);
            return redirect('/loans')->with('msg','update');
        } catch (\Exception $e) {
            return redirect('/loans')->with('msg','error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->loanRepository->delete($id);
            return redirect('/loans')->with('msg','delete');
        } catch (\Exception $e) {
            return redirect('/loans')->with('msg','error');
        }
    }
}
