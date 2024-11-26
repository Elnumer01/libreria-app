<?php

namespace Tests\Browser\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'elnumero1@gmail.com')
                    ->type('password', '12345678')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/books')
                    ->assertSee('Libros');
        });
    }
}
