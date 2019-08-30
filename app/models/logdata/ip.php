<?php

namespace App\models\logdata;

use Illuminate\Database\Eloquent\Model;

class ip extends Model
{
    public static function saveData(){
    	$ip = $_SERVER['REMOTE_ADDR'];
    	$ifexist = ip::where('ip', $ip)->first();
    	if ($ifexist === null) {
    		$ipObj = new ip;
    		$ipObj->ip = $ip;
    		$ipObj->save();
    		return $ipObj->id;
    	}
    	return $ifexist->id;
    }
}
