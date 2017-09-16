<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
	public function view(){
		return view('pages/home', ['view' => 'home']);
	}
}
