<?php

namespace App\models\logdata;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\browserInfoCOntroller;
class browser extends Model
{
    public static function saveData(){
    	$currentBrowser = browserInfoCOntroller::currentUserBrowser();
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
