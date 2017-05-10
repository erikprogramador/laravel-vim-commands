<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;

/**
 * Class: CommandController
 *
 * @author Erik Vanderlei Fernandes <erik.vanderlei.programador@outlook.com>
 * @see Controller
 */
class CommandController extends Controller
{
    /**
     * Return a list of all commands
     *
     */
    public function index()
    {
        return Command::all();
    }

    /**
     * Store a command
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        try {
            $command = Command::create($request->only(['title', 'command', 'description']));
        } catch (Exception $e) {
            return response([
                'message' => 'Error on create command!'
            ], 500);
        }

        return response(compact('command'), 201);
    }

    /**
     * Update a command
     *
     * @param Request $request
     * @param Command $command
     */
    public function update(Request $request, Command $command)
    {
        $this->validateRequest($request);

        $command->update($request->only(['title', 'command', 'description']));
        $command->fresh();

        return response($command, 200);
    }

    /**
     * Delete a command from database
     *
     * @param Command $command
     */
    public function destroy(Command $command)
    {
        $command->delete();

        return response([
            'message' => 'The record was deleted with success!'
        ], 200);
    }

    /**
     * Validate the request
     *
     * @param Request $request
     */
    protected function validateRequest(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'command' => 'required|max:255',
            'description' => 'required',
        ]);
    }
}
