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
        $command = factory(Command::class)->make();

        $this->post('/api/store', $command->toArray())
             ->assertStatus(201);

        $this->assertDatabaseHas('commands', ['title' => $command->title]);
    }
}
