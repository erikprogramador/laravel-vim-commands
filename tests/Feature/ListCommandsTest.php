<?php

namespace Tests\Feature;

use App\Command;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListCommandsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function should_return_all_commands()
    {
        $commands = factory(Command::class, 2)->create();

        $this->get('/api/commands')
            ->assertJsonFragment($commands[0]->toArray())
            ->assertJsonFragment($commands[1]->toArray());
    }
}
