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

    protected $storeUrl = '/api/store';

    /** @test */
    function can_create_a_command()
    {
        $command = $this->makeCommand();

        $this->post($this->storeUrl, $command->toArray());

        $this->assertDatabaseHas('commands', ['title' => $command->title]);
    }

    /** @test */
    function when_create_a_command_then_the_created_command_shold_be_returned_with_the_created_status_code()
    {
        $command = $this->makeCommand()->toArray();

        $this->post($this->storeUrl, $command)
            ->assertStatus(201)
            ->assertJsonFragment($command);
    }

    /** @test */
    function a_command_must_have_a_title()
    {
        $this->post($this->storeUrl, $this->makeCommand(['title' => null])->toArray())
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    function a_command_must_have_a_command()
    {
        $this->post($this->storeUrl, $this->makeCommand(['command' => null])->toArray())
            ->assertSessionHasErrors(['command']);
    }

    /** @test */
    function a_command_must_have_a_description()
    {
        $this->post($this->storeUrl, $this->makeCommand(['description' => null])->toArray())
            ->assertSessionHasErrors(['description']);
    }

    protected function makeCommand($attributes = [])
    {
        return factory(Command::class)->make($attributes);
    }
}
