<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_registered_users_can_login()
    {
        factory(User::class)->create(['email' => 'carlosarroyoam@gmail.com', 'password' => bcrypt('secret')]);

        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                    ->type('email', 'carlosarroyoam@gmail.com')
                    ->type('password', 'secret')
                    ->press('[type="submit"]')
                    ->assertPathIs(route('home'));
        });
    }
}
