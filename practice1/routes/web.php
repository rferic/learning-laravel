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

Route::get('/', 'PagesController@view');
Route::get('/tickets', 'TicketsController@index');
Route::get('/tickets/{slug?}', 'TicketsController@show');
Route::get('/tickets/{slug?}/edit', 'TicketsController@edit');

Route::post('/tickets', 'TicketsController@store');
Route::post('/tickets/{slug?}/edit', 'TicketsController@update');
Route::post('/tickets/{slug?}/destroy', 'TicketsController@destroy');
Route::post('/comment', 'CommentsController@make');

/*TEST EMAIL*/
Route::get('sendmail', function(){
	Mail::send('emails.welcome', Array('name' => 'Laravel Practice1'), function($message){
		$message->from('multimediospower@gmail.com');
		$message->to('multimediospower@gmail.com');
	});
	
	return 'Email has been sended';
});

/*
//FIRST ROUTE
Route::get('/first-uri', function(){
	return 'Primera ruta';
});

//NAME IS REQUIRED
Route::get('/users/{name}', function($name){
	return $name;
});

//NAME IS OPTIONAL BUT NAME MUST CONTAIN ONLY ALPHABETIC CARACTER
Route::get('/users-optional/{name?}', function($name = 'Anonimous'){
	return $name;
})->where('name', '[a-zA-Z]+');

//EXAMPLE DE ROUTE FOR GET & POST
Route::get('/users', function(){
	//return all users
});*/

Route::post('/users', function(){
	//create new user
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
