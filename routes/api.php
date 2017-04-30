<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('store', 'CommandController@store');
Route::get('commands', 'CommandController@index');
Route::delete('command/delete/{command}', 'CommandController@destroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
