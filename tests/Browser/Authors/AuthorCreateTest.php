<?php

namespace Tests\Browser\Authors;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Rol;
use App\Repositories\AuthorRepository;
use App\Repositories\UserRepository;
class AuthorCreateTest extends DuskTestCase
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

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/authors')
                    ->assertSee('Autores')
                    ->click('#modalcreateauthor')
                    ->pause(2000)
                    ->type('#createautorname', 'Eric')
                    ->type('#createlastnameauthor', 'Martinez')
                    ->type('#createaddressauthor', 'viñedos')
                    ->type('#createcityauthor', 'Torreón')
                    ->click('#createauthor')
                    ->pause(2000)
                ;
        });

        $repository = new UserRepository();

        $repository->delete($user->id);
    }
}
