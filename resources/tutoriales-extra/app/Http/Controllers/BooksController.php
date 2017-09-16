<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use \Yajra\Datatables\Facades\Datatables;

class BooksController extends Controller
{
	public function index()
	{
		return view('books.list');
	}

	public function booksData()
	{
		$model = Book::with('libraries', 'author')->withTrashed();
		$actions = 'books.datatables.actions';

		return Datatables::eloquent($model)
		                 ->addColumn('actions', $actions)
		                 ->make(true);
	}
}
