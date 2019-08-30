<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\logdata\log;

class logsDataController extends Controller
{
    public function index(){
    	$log = log::saveData(2);
    	$logsHistory = log::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
    	return view('custom.logs', compact('logsHistory'));
    }
}
