<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
	protected $guarded = ['id'];
	protected $fillable = ['name', 'price'];

	public function pizzas(){
		//TODO RETURN ALL PIZZAS CONTAIN THIS INGREDIENT (PIVOT TABLE) => MANY TO MANY
		return $this->belongsToMany('App\Pizza');
	}
}
