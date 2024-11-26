<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LoanRepositoryInterface;
class LoanController extends Controller
{
    private $loanRepository;

    public function __construct(LoanRepositoryInterface $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $books = $this->loanRepository->getAll();
            return response()->json([
                'message' => 'list loans',
                'loans' => $books
            ],201);
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
        $validatedData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'status' => 'required'
        ]);

        $loan = $this->loanRepository->create($validatedData);

        return response()->json([
            'message' => 'loan created successfully',
            'loan' => $loan,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $loan = $this->loanRepository->getById($id);
            return response()->json($loan,201);
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
            $updatedLoan = $this->loanRepository->update($id, $validatedData);
            return response()->json([
                'message' => 'Loan updated successfully',
                'book' => $updatedLoan,
            ],201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->loanRepository->delete($id);
            return response()->json(['message' => 'Loan deleted successfully'],201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
    }
}
