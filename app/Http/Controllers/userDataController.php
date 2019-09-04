<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use App\models\userdata\state;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\models\logdata\log;
use App\Http\Requests\changePasswordRequest;
use App\User;

class userDataController extends Controller
{
    public function states($id){
        return state::getStates($id);
    }

    public function apiKeys(){
    	$apiKey = Str::random(25);
        $save = User::APIsave($apiKey);
        $log = log::saveData(5);
    	return view('custom.api', compact('apiKey'));
    }

    public function localization($locale){
        if(Auth::check()){
            App::setLocale($locale);
            $log = log::saveData(4);
            return view('custom.localization');
        }
        return redirect()->route('login');
    }

    public function changePasswordView(){
        $log = log::saveData(6);
        return view('custom.change');
    }

    public function changePasswordSave(changePasswordRequest $request){
        $request->validated();
        User::passwordSave($request->newPassword);
        return redirect()->route('change.view')->with('success', 'Your password has been changed');
    }
}
