<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoadTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLoad()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('StudyMate');
        });
    }
}
