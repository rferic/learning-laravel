<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ['id'];
	protected $fillable = ['name'];

	public function users(){
		//TODO RETURN ALL USERS WITH THIS ROLE => ONE TO MANY
		$this->hasMany('App\User');
	}
}
