<?php

namespace App\models\logdata;

use Illuminate\Database\Eloquent\Model;

class agent extends Model
{
    public static function saveData(){
    	$agentInfo = $_SERVER['HTTP_USER_AGENT'];
    	$ifexist = agent::where('agent_info', $agentInfo)->first();
    	if ($ifexist === null) {
    		$agentObj = new agent;
    		$agentObj->agent_info = $agentInfo;
    		$agentObj->save();
    		return $agentObj->id;
    	}
    	return $ifexist->id;
    }
}
