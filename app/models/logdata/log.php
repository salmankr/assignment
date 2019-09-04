<?php

namespace App\models\logdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\models\logdata\browser;
use App\models\logdata\agent;
use App\models\logdata\ip;
use Illuminate\Http\Request;

class log extends Model
{
    public static function saveData($status_id){
    	$browser_id = browser::saveData();
    	$agent_id = agent::saveData();
    	$ip_id = ip::saveData();
    	$logObj = new log;
    	$logObj->user_id = Auth::id();
    	$logObj->status_code_id = $status_id;
    	$logObj->browser_id = $browser_id;
    	$logObj->ip_id = $ip_id;
    	$logObj->agent_id = $agent_id;
    	$logObj->save();
    	return true;
    }

    public static function logHistory(){
        return log::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function agent(){
        return $this->belongsTo('App\models\logdata\agent','agent_id');
    }

    public function status(){
        return $this->belongsTo('App\models\logdata\status_code','status_code_id');
    }

    public function browser(){
        return $this->belongsTo('App\models\logdata\browser','browser_id');
    }

    public function ip(){
        return $this->belongsTo('App\models\logdata\ip','ip_id');
    }
}
