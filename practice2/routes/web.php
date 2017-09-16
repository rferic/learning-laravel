<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//TODO GROUP AUTH ROUTES (REQUIRED LOGIN)
Route::group(['middleware' => ['auth']], function(){
	Route::resource('pizzas', 'PizzaController');
    Route::patch('pizzas/{id}/restore', 'PizzaController@restore')->name('pizzas.restore');
	Route::resource('ingredients', 'IngredientController');
});

//TODO prefix for access to Admin
Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function(){
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('users', 'Admin\UserController', ['as' => 'admin']);
    Route::resource('pizzas', 'Admin\PizzaController', ['as' => 'admin']);
    Route::resource('ingredients', 'Admin\IngredientController', ['as' => 'admin']);
    Route::resource('ingredients-pizzas', 'Admin\IngredientPizzaController', ['as' => 'admin']);
});
