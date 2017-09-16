<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{
    use SoftDeletes;

    public function album(){
        //TODO examplete: Picture can asign one Album (One to One)
        return $this->belongsTo('App\Album');
    }
}
