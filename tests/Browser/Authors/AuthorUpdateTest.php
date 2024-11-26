<?php

namespace Tests\Browser\Authors;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
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

        $repository = new UserRepository();

        $repository->delete($user->id);

    }
}
