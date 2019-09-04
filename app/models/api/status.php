<?php

namespace App\models\api;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    public static function getStatus($id){
    	return status::where('id', $id)->first();
    }
}
