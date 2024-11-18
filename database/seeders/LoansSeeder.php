<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;
class LoansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Loan::create([
            'user_id' => 1,
            'book_id' => 1,
            'status' => 'Pendiente',
        ]);

        Loan::create([
            'user_id' => 2,
            'book_id' => 2,
            'status' => 'Disponible',
        ]);

        Loan::create([
            'user_id' => 3,
            'book_id' => 3,
            'status' => 'Regresado',
        ]);
    }
}
