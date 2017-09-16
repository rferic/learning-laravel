<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    public function books(){
        //TODO examplete: Library can contain many Books (Many to Many)
        return $this->belongsToMany('App\Book');
    }
}
