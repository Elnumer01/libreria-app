<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Gabriel',
            'lastname' => 'García Márquez',
            'address' => 'Calle Macondo 123',
            'city' => 'Aracataca',
        ]);

        Author::create([
            'name' => 'Jane',
            'lastname' => 'Austen',
            'address' => 'Steventon Rectory',
            'city' => 'Hampshire',
        ]);

        Author::create([
            'name' => 'Mark',
            'lastname' => 'Twain',
            'address' => 'Hannibal 456',
            'city' => 'Missouri',
        ]);
    }
}
