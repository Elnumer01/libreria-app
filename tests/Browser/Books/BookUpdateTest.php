<?php

namespace Tests\Browser\Books;

use App\Models\Author;
use App\Models\Rol;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Book;
use App\Repositories\BooksRepository;
use App\Repositories\UserRepository;

class BookUpdateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $user = User::create([
            'name' => "Romario",
            'email' => "romario1234343@gmail.com",
            'rol_id' => 1,
            'password'=>bcrypt('12345678')
        ]);

        $author = Author::create([
            'name' => 'John',
            'lastname' => 'Doe',
            'address' => '123 Main St',
            'city' => 'New York',
        ]);

        $book = Book::create([
                'title' => 'Book 1',
                'description' => 'Desc 1',
                'isbn' => '111-111-111',
                'gender' => 'Fiction',
                'author_id' => $author->id,
                'status' => true
            ]);


        $this->browse(function (Browser $browser)  use ($user){
            $browser->loginAs($user)
                    ->visit('/books')
                    ->assertSee('Libros')
                    ->click('#modalupdatebook')
                    ->pause(2000)
                    ->type('#updatetitlebook', 'juegos del hambre en llamas')
                    ->click('#updatebook')
                    ->pause(2000)
                    ;
        });

        $repository = new BooksRepository();
        $this->assertTrue($repository->delete($book->id));

        $repository = new UserRepository();

        $repository->delete($user->id);
    }
}
