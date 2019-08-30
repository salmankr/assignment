<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use App\models\userdata\state;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\models\logdata\log;
use App\Http\Requests\changePasswordRequest;
use App\User;

class userDataController extends Controller
{
    public function states($id){
    	$states = state::where('country_id', $id)->get();
    	return $states;
    }

    public function apiKeys(){
    	$apiKey = Str::random(25);
    	$user = Auth::user();
    	$user->forceFill([
            'api_key' => Hash::make($apiKey),
        ])->save();
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
        $user = Auth::user();
        if (Hash::check($request->newPassword, $user->password)){
            return redirect()->route('change.view')->with('error', 'Your cannot use old password as new password');
        }
        elseif (Hash::check($request->oldPassword, $user->password)){
            User::where('id', $user->id)->update(['password' => Hash::make($request->newPassword)]);
            return redirect()->route('change.view')->with('success', 'Your password has been changed');
        }else{
            return redirect()->route('change.view')->with('error', 'Your old password did not matched our records');
        }
    }
}
