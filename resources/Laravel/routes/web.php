<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['middleware' => 'auth'], function()
{
    Route::resource('pizzas', "PizzaController");
    Route::patch('pizzas/{id}/restore', 'PizzaController@restore')->name('pizzas.restore');
});

Route::group(['middleware' => 'admin', 'prefix' => 'administration'], function()
{
    Route::get('/', 'AdminController@index')->name('admin.panel');

    Route::resource('users', 'Admin\UserController', [
        'as' => 'admin'
    ]);

    Route::resource('pizzas', 'Admin\PizzaController', [
        'as' => 'admin'
    ]);

    Route::resource('ingredients', 'Admin\IngredientController', [
        'as' => 'admin'
    ]);

    Route::resource('ingredients_pizzas', 'Admin\IngredientPizzaController', [
        'as' => 'admin'
    ]);
});