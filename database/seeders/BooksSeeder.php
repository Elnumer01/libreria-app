<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Cien Años de Soledad',
            'description' => 'Una novela sobre la familia Buendía y el pueblo de Macondo.',
            'isbn' => '9780307474728',
            'gender' => 'Realismo mágico',
            'author_id' => 1,
            'status' => true,
        ]);

        Book::create([
            'title' => 'Orgullo y Prejuicio',
            'description' => 'Una historia romántica en la Inglaterra rural.',
            'isbn' => '9780141439518',
            'gender' => 'Romance',
            'author_id' => 2,
            'status' => true,
        ]);

        Book::create([
            'title' => 'Las Aventuras de Tom Sawyer',
            'description' => 'Las aventuras de un joven en el río Mississippi.',
            'isbn' => '9780486400778',
            'gender' => 'Aventura',
            'author_id' => 3,
            'status' => true,
        ]);
    }
}
