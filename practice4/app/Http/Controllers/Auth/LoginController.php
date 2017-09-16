<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\View\View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //TODO When User login has been successfully check if User is subscribed
    //TODO If check is true redirect to Profile View
    //TODO Else if check is false redirect to Subscription View (list subscriptions plans)
    /**
     * [redirectPath description]
     * @return [type] [description]
     */
    public function redirectPath(){
        return  (!auth()->user()->isSuscribed()) ? '/subscription' : '/profile';
    }
}
