<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'api_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

	//TODO RELATION PIZZAS TO USERS
	public function pizzas(){
		//TODO RETURN ALL PIZZAS BY THIS USER => ONE TO MANY
		return $this->hasMany('App\Pizza');
	}

	//RELATION PIZZAS TO USERS
	public function role(){
		//RETURN ROLES BY THIS USER => ONE TO ONE
		return $this->belongsTo('App\Role');
	}
}
