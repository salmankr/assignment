<?php

namespace App\models\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class user_role extends Model
{
	protected $fillable = [
	    'role_id', 'user_id',
	];

    public static function saveData($roleid, $userid){
    	$userRole = new user_role;
    	$userRole->forceFill([
            'role_id' => $roleid,
            'user_id' => $userid,
        ])->save();
    }
}
