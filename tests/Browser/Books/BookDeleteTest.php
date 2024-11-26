<?php

namespace Tests\Browser\Books;

use App\Models\Rol;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Repositories\UserRepository;
class BookDeleteTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $rol = Rol::create([
            'rol' => 1
        ]);

        $user = User::create([
            'name' => "Romario",
            'email' => "romario1234343@gmail.com",
            'rol_id' => $rol->id,
            'password'=>bcrypt('12345678')
        ]);


        $this->browse(function (Browser $browser)  use ($user){
            $browser->loginAs($user)
                    ->visit('/books')
                    ->assertSee('Libros')
                    ->click('#modaldeletebook')
                    ->pause(2000)
                    ;
        });

        $repository = new UserRepository();

        $repository->delete($user->id);
    }
}
