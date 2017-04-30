<?php

namespace Tests\Feature;

use App\Command;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateCommandTest extends TestCase
{
    use DatabaseMigrations;

    protected $url = '/api/command/update/';

    /** @test */
    function can_update_a_existing_command()
    {
        $command = factory(Command::class)->create();
        $newTitle = 'Some New title';

        $information = [
            'id' => $command->id,
            'title' => $newTitle,
            'command' => $command->command,
            'description' => $command->description
        ];

        $this->put($this->url . $command->id, $information)
            ->assertStatus(200)
            ->assertJsonFragment($information);

        $this->assertEquals($newTitle, Command::find($command->id)->title);
    }

    /** @test */
    function can_update_all_attributes_of_a_command()
    {
        $command = factory(Command::class)->create();
        $newTitle = 'Run all tests on a file';
        $newCommand = ',tf';
        $newDescription = 'Works just with phpunit';

        $information = [
            'id' => $command->id,
            'title' => $newTitle,
            'command' => $newCommand,
            'description' => $newDescription
        ];

        $this->put($this->url . $command->id, $information)
            ->assertStatus(200)
            ->assertJsonFragment($information);

        $command = Command::find($command->id);

        $this->assertEquals($newTitle, $command->title);
        $this->assertEquals($newCommand, $command->command);
        $this->assertEquals($newDescription, $command->description);
       
    }

    /** @test */
    function a_command_must_have_a_title()
    {
        $command = factory(Command::class)->create();
        $newCommand = ',tf';
        $newDescription = 'Works just with phpunit';

        $information = [
            'id' => $command->id,
            'title' => null,
            'command' => $newCommand,
            'description' => $newDescription
        ];

        $this->put($this->url . $command->id, $information)
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    function a_command_must_have_a_command()
    {
        $command = factory(Command::class)->create();
        $newTitle = 'Run all tests on a file';
        $newDescription = 'Works just with phpunit';

        $information = [
            'id' => $command->id,
            'title' => $newTitle,
            'command' => null, 
            'description' => $newDescription
        ];

        $this->put($this->url . $command->id, $information)
            ->assertSessionHasErrors(['command']);
    }

    /** @test */
    function a_command_must_have_a_description()
    {
        $command = factory(Command::class)->create();
        $newTitle = 'Run all tests on a file';
        $newCommand = ',tf';

        $information = [
            'id' => $command->id,
            'title' => $newTitle,
            'command' => $newCommand,
            'description' => null 
        ];

        $this->put($this->url . $command->id, $information)
            ->assertSessionHasErrors(['description']);
    }

}
