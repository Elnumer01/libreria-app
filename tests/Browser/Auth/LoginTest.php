<?php

namespace Tests\Browser\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Rol;
use App\Repositories\UserRepository;
class LoginTest extends DuskTestCase
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

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'elnumero1@gmail.com')
                    ->type('password', '12345678')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/books')
                    ->assertSee('Libros');
        });

        $repository = new UserRepository();

        $repository->delete($user->id);
    }
}