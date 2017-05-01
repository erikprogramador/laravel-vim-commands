<?php

namespace Tests\Feature;

use App\Command;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateVimCommandTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_create_a_command()
    {
        $command = $this->makeCommand();

        $this->post('/api/store', $command->toArray());

        $this->assertDatabaseHas('commands', ['title' => $command->title]);
    }

    /** @test */
    function when_create_a_command_then_the_created_command_shold_be_returned_with_the_created_status_code()
    {
        $command = $this->makeCommand();

        $this->post('/api/store', $command->toArray())
            ->assertStatus(201)
            ->assertJsonFragment($command->toArray());
    }

    /** @test */
    function a_command_must_have_a_title()
    {
        $command = $this->makeCommand(['title' => null]);

        $this->post('/api/store', $command->toArray())
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    function a_command_must_have_a_command()
    {
        $command = $this->makeCommand(['command' => null]);

        $this->post('/api/store', $command->toArray())
            ->assertSessionHasErrors(['command']);
    }

    /** @test */
    function a_command_must_have_a_description()
    {
        $command = $this->makeCommand(['description' => null]);

        $this->post('/api/store', $command->toArray())
            ->assertSessionHasErrors(['description']);
    }

    protected function makeCommand($attributes = [])
    {
        return factory(Command::class)->make($attributes);
    }
}
