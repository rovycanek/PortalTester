<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LoginLog;

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


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $ip=new LoginLog;
        $ip->fingerprint = $request->header('User-Agent');
        $ip->user_id =  $user->id;
        $ip->ip =  $request->getClientIp();
        $ip->save();
        if(Auth::user()->hasRole('admin')){
            return redirect('admin/users') ;
        }        
        if(Auth::user()->hasRole('user')){
            return redirect('IPs') ;
        }
        if(Auth::user()->hasRole('')){
            return redirect('home') ;
        }
        
    }

    public function redirectTo()
    {

    }
}
