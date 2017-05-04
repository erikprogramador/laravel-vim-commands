<?php

namespace Tests\Browser;

use App\Command;
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
    function verify_if_when_dont_have_commands_the_home_should_show_a_message()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertVisible('.no-content');
        });
    }


    /** @test */
    function verify_if_when_have_commands_the_home_should_not_show_a_message()
    {
        $command = factory(Command::class)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertMissing('.no-content');
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

    /** @test */
    function when_goes_to_the_home_page_i_should_see_all_the_commands()
    {
        $commands = factory(Command::class, 2)->create();

        $this->browse(function (Browser $browser) use ($commands) {
            $browser->visit('/')
                    ->assertSee($commands->first()->title)
                    ->assertSee($commands->first()->command)
                    ->assertSee($commands->first()->description)
                    ->assertSee($commands->last()->title)
                    ->assertSee($commands->last()->command)
                    ->assertSee($commands->last()->description);       
        });
        
    }
}
