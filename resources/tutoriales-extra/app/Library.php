<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
	public function books()
	{
		return $this->belongsToMany('App\Book');
	}
}
