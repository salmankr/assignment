<?php

namespace App\models\logdata;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\getBrowser;
class browser extends Model
{
    public static function saveData(){
    	$currentBrowser = getBrowser::browserName();
    	$ifexist = browser::where('name', $currentBrowser)->first();
    	if ($ifexist === null) {
    		$browserObj = new browser;
    		$browserObj->name = $currentBrowser;
    		$browserObj->save();
    		return $browserObj->id;
    	}
    	return $ifexist->id;
    }
}
