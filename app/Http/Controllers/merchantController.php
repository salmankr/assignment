<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\models\userdata\country;
use App\Http\Requests\subUserRequest;
use App\models\api\user_role;

class merchantController extends Controller
{
    public function userFormView(){
    	$title = 'User Signup';
    	$route = 'userFormSubmit';
    	$countries = country::all();
    	return view('auth.register', compact('countries', 'route', 'title'));
    }

    public function userFormSubmit(subUserRequest $request){
    	$request->validated();
    	$subUserid = User::subUserSaveData($request);
        if($request->has('read')){
            user_role::saveData($request->read, $subUserid);
        }
        if($request->has('write')){
            user_role::saveData($request->write, $subUserid);
        }
    	return redirect(route('userFormView'))->with('message', 'Your sub-user is registered');
    }
}
