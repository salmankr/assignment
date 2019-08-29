<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\userdata\state;

class userDataController extends Controller
{
    public function states($id){
    	$states = state::where('country_id', $id)->get();
    	return $states;
    }
}
