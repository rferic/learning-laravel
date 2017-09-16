<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable; //TODO Require for integrate Cashier

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //TODO Specificate Date Attributes
    protected $dates = ['created_at', 'ends_at'];

    //TODO Return is Suscribe
    /**
     * [isSuscribed description]
     * @return boolean [description]
     */
    public function isSuscribed(){
        return !(
            !$this->subscribed('main-monthly') && //TODO Monthly Subscriptions
            !$this->subscribed('main-monthly') && //TODO Three Months Subscriptions
            !$this->subscribed('main-monthly') //TODO Yearly Subscriptions
        );
    }
}
