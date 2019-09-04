<?php

namespace App\models\api;

use Illuminate\Database\Eloquent\Model;

class response extends Model
{
    public static function saveData($response, $request_id, $status_id){
    	$responseObj = new response;
    	$responseObj->status_id = $status_id;
    	$responseObj->request_id = $request_id;
    	$responseObj->description = $response['description'];
    	$responseObj->raw_data = json_encode($response);
    	$responseObj->save();
    }
}
