<?php

namespace App\models\api;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    public static function saveData($user_id){
    	$paymentObj = new payment;
    	$paymentObj->user_id = $user_id;
    	$paymentObj->payment = 10;
    	$paymentObj->save();
    	return true;
    }
}
