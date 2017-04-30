<?php

namespace Tests\Feature;

use App\Command;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteCommandTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function delete_a_existing_vim_command()
    {
        $command = factory(Command::class)->create();

        $this->delete('/api/command/delete/' . $command->id)
            ->assertStatus(410)
            ->assertJsonFragment([
                'message' => 'The record was deleted with success!'
            ]);

        $this->assertDatabaseMissing('commands', ['id' => $command->id]);
    }

    /** @test */
    function can_not_delete_a_command_which_not_exits()
    {
        $this->delete('/api/command/delete/22')
            ->assertStatus(404);
    }
}
