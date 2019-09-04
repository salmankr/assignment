<?php

namespace App\models\userdata;

use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    public function country(){
        return $this->belongsTo('App\models\userdata\country','country_id');
    }

    public static function getStates($id){
    	return state::where('country_id', $id)->get();
    }
}
