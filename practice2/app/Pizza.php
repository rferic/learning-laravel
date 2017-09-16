<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //TODO FOR USE LOGIC REMOVE

class Pizza extends Model
{
	use SoftDeletes; //TODO FOR USE LOGIC REMOVE

	protected $fillable = ['user_id', 'name', 'description', 'price'];

	public function user(){
		//TODO RETURN USER OF THIS PIZZA => ONE TO ONE
		return $this->belongsTo('App\User');
	}

	public function ingredients(){
		//TODO RETURN ALL INGREDIENTS OF THIS PIZZA (PIVOT TABLE) => MANY TO MANY
		return $this->belongsToMany('App\Ingredient');
	}
}
