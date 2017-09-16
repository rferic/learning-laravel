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

Route::get('books', '\App\Http\Controllers\BooksController@index')->name('books.list');
Route::get('booksData', '\App\Http\Controllers\BooksController@booksData')->name('books.data');
Route::get('books/{id}', '\App\Http\Controllers\BooksController@edit')->name('books.edit');
Route::delete('books/{id}', '\App\Http\Controllers\BooksController@remove')->name('books.delete');

Route::get('albums', '\App\Http\Controllers\AlbumsController@index')->name('albums.list');
Route::get('albumsData', '\App\Http\Controllers\AlbumsController@albumsData')->name('albums.data');
Route::get('albums/create', '\App\Http\Controllers\AlbumsController@create')->name('albums.create');
Route::get('albums/edit/{id}', '\App\Http\Controllers\AlbumsController@edit')->name('albums.edit');
Route::post('albums', '\App\Http\Controllers\AlbumsController@store')->name('albums.store');
Route::put('albums/{id}', '\App\Http\Controllers\AlbumsController@update')->name('albums.update');
Route::delete('albums/{id}', '\App\Http\Controllers\AlbumsController@remove')->name('albums.delete');

Route::post('pictures/upload', '\App\Http\Controllers\PicturesController@upload')->name('pictures.upload');
Route::delete('pictures/destroy', '\App\Http\Controllers\PicturesController@remove')->name('pictures.remove');
