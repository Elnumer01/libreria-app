<?php

namespace Tests\Browser\Books;

use App\Models\Rol;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Repositories\UserRepository;

class BookCreateTest extends DuskTestCase
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

        $this->browse(function (Browser $browser)  use ($user){
            $browser->loginAs($user)
                    ->visit('/books')
                    ->assertSee('Libros')
                    ->click('#modalcreatebook')
                    ->pause(2000)
                    ->type('#createtitlebook', 'juegos del hambre')
                    ->type('#createdescriptionbook', 'Cada ciudadano debe ver pelear a muerte a los jóvenes')
                    ->type('#createisbnbook', '678678564')
                    ->type('#creategenderbook', 'accion, suspenso')
                    ->select('#createauthor_id_book',1)
                    ->click('#createbook')
                    ->pause(2000)
                    ;
        });

        $repository = new UserRepository();

        $repository->delete($user->id);
    }
}
