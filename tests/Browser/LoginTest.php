<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login');

            $browser->value('#username', 'royberris');
            $browser->value('#password', 'test123');
            $browser->click('@login-button');

            $browser->assertAuthenticated();
        });
    }
}
