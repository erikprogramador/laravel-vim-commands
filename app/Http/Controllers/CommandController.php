<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    public function index()
    {
        return Command::all();
    }

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

    public function update(Request $request, Command $command)
    {
        $this->validateRequest($request);

        $command->update($request->only(['title', 'command', 'description']));
        $command->fresh();

        return response($command, 200);
    }

    public function destroy(Command $command)
    {
        $command->delete();

        return response([
            'message' => 'The record was deleted with success!'
        ], 200);
    }

    public function validateRequest(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'command' => 'required|max:255',
            'description' => 'required',
        ]);
    }
}
