<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\models\logdata\log;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $log = log::saveData(3);
        $id = Auth::id();
        $userObj = User::find($id);
        if($userObj->email_verified_at == null){
            $message = $userObj->name . '! Please verify your email first';
            return view('home', compact('message'));
        }
        return view('home', compact('userObj'));
    }
}
