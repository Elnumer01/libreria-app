<?php

namespace Tests\Browser\Authors;

use App\Models\Rol;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use App\Repositories\UserRepository;
class AuthorUpdateTest extends DuskTestCase
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
            'name' => 'Author 3',
            'lastname' => 'Lastname 3',
            'address' => 'Address 3',
            'city' => 'City 3'
        ]);


        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/authors')
                    ->assertSee('Autores')
                    ->click('#modalupdateauthor')
                    ->pause(2000)
                    ->clear('#updateautorname')
                    ->type('#updateautorname', 'Romario')
                    ->click('#updateauthor')
                    ->pause(2000)
                ;
        });

        $repositoryauthor = new AuthorRepository();

        $repositoryauthor->delete($author->id);

        $repository = new UserRepository();

        $repository->delete($user->id);

    }
}
