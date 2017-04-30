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
    public function can_create_a_command()
    {
        $command = factory(Command::class)->make();

        $this->post('/api/store', $command->toArray())
             ->assertStatus(201);

        $this->assertDatabaseHas('commands', ['title' => $command->title]);
    }

    /** @test */
    public function when_create_a_command_then_the_created_command_shold_be_returned()
    {
        $command = factory(Command::class)->make();

        $this->post('/api/store', $command->toArray())
            ->assertStatus(201)
            ->assertJsonFragment($command->toArray());
    }
}
