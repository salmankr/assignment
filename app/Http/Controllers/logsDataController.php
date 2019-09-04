<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Contracts\logContract;
use App\models\logdata\log;

class logsDataController extends Controller
{
    public function index(LogContract $logs){
    	$logsHistory = $logs->logHistory();
    	$log = log::saveData(2);
    	return view('custom.logs', compact('logsHistory'));
    }
}
