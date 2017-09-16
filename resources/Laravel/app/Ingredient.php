<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'name', 'price'
    ];

    public function pizzas()
    {
        return $this->belongsToMany('App\Pizza');
    }
}
