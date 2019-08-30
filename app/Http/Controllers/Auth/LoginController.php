<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\models\logdata\log;
use Illuminate\Http\Request;

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

    public function login(Request $request){
        $validate = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if(isset($request->remember) && $request->remember == 'on'){
            $remember = true;
        }else{
            $remember = false;
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $log = log::saveData(1);
            return redirect()->intended('home');
        }
        return redirect()->route('login')->with('message', 'Credentials does not match');
    }
}
