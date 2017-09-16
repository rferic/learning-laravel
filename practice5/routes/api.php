<?php

use Illuminate\Http\Request;

//TODO Use Facede\Route for view info of Methods and other info
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//TODO Route for API (use Tranformer for response) => Call Controller
//TODO URL case: {domain}/api/v1/{resource} => {resource} = projects
Route::group(['prefix' => 'v1'], function(){
    Route::resource('projects', 'ProjectController');
});
