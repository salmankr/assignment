<?php

namespace App\models\api;

use Illuminate\Database\Eloquent\Model;

class billing extends Model
{
    public static function saveData($user_id, $request_id){
    	$billObj = new billing;
    	$billObj->user_id = $user_id;
    	$billObj->request_id = $request_id;
    	$billObj->save();
    }
}
