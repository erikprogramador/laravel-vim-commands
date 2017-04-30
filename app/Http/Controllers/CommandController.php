<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    public function store(Request $request)
    {
        $command = Command::create($request->only(['title', 'command', 'description']));
        // try {
        // } catch (Exception $e) {
        //     return response([
        //         'message' => 'Error on create command!'
        //     ], 500);
        // }

        return response([], 201);
    }
}
