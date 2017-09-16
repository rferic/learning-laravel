<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books(){
        //TODO examplete: Author can has many Books (Many to Many)
        return $this->belognsToMany('App\Book');
    }
}
