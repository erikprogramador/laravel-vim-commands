<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'command' => 'required|max:255',
            'description' => 'required',
        ]);

        try {
            $command = Command::create($request->only(['title', 'command', 'description']));
        } catch (Exception $e) {
            return response([
                'message' => 'Error on create command!'
            ], 500);
        }

        return response(compact('command'), 201);
    }
}
