<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomeTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    function see_if_the_home_contains_the_title()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Vim');
        });
    }

    /** @test */
    function see_if_the_home_contains_the_create_link()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSeeLink('Create');
        });
    }

    /** @test */
    function see_if_the_home_contains_the_reset_state_link()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSeeLink('Reset Page');
        });
    }
}
