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

    /** @test */
    function check_if_when_type_to_the_search_input_and_click_on_reset_link_the_input_is_clean()
    {
        $this->browse(function (Browser $browser) {
            $text = 'Create command';
            $field = '#search';
            $browser->visit('/')
                    ->type($field, $text)
                    ->assertInputValue($field, $text)
                    ->clickLink('Reset Page')
                    ->assertInputValueIsNot($field, $text); 
        });
    }
}
