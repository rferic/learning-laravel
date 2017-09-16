<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/books', '\App\Http\Controllers\BooksController@index')->name('books.list');
Route::get('/booksData', '\App\Http\Controllers\BooksController@booksData')->name('books.data');
Route::get('/books/{id}', '\App\Http\Controllers\BooksController@edit')->name('books.edit');
Route::delete('/books/{id}', '\App\Http\Controllers\BooksController@remove')->name('books.delete');

Route::get('/albums/create', '\App\Http\Controllers\AlbumsController@create')->name('albums.create');
Route::get('/albums/edit/{id}', '\App\Http\Controllers\AlbumsController@edit')->name('albums.edit');
Route::post('/albums', '\App\Http\Controllers\AlbumsController@store')->name('albums.store');
Route::put('/albums/{id}', '\App\Http\Controllers\AlbumsController@update')->name('albums.update');
Route::post('/pictures/upload', '\App\Http\Controllers\PicturesController@upload')->name('pictures.upload');
Route::delete('/pictures/destroy', '\App\Http\Controllers\PicturesController@remove')->name('pictures.remove');
