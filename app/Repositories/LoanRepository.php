<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Repositories\Interfaces\LoanRepositoryInterface;
use Illuminate\Support\Facades\DB;
class LoanRepository implements LoanRepositoryInterface
{
    public function getAll()
    {
          return DB::table('loans')
        ->join('users','loans.user_id','=', 'users.id')
        ->join('books','loans.book_id','=','books.id')
        ->select('users.name','books.title',DB::raw("DATE_FORMAT(loans.created_at, '%d/%m/%Y') AS fecha"))
        ->get();

    }

    public function getById($id)
    {
        return Loan::findOrFail($id);
    }

    public function create(array $data)
    {
        return Loan::create($data);
    }

    public function update($id, array $data)
    {
        $Loan = $this->getById($id);
        $Loan->update($data);
        return $Loan;
    }

    public function delete($id)
    {
        $Loan = $this->getById($id);
        $Loan->delete();
        return true;
    }
}

