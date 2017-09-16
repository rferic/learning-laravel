<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Yajra\Datatables\Facades\Datatables;

class BooksController extends Controller
{
    public function index(){
        return view('books.list');
    }

    //TODO method for use Datatables
    public function booksData(){
        //TODO get Model with dependencies and including items has been logic removed
        $model = Book::with('libraries', 'author')->withTrashed();
        //TODO specificate view for call action
        $actions = 'books.datatables.actions';
        //TODO create a Datatables
        //TODO eloquetn => for specificate that working with a model (ORM)
        //TODO addColumn => add column with print view specificate
        return Datatables::eloquent($model)->addColumn('actions', $actions)->make(true);
    }
}
