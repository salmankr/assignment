<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class browserInfoCOntroller extends Controller
{
    public static function currentUserBrowser(){
    	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE){
    		return 'Internet explorer';
    	}
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE){
        	return 'Internet explorer';
        }
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
        	return 'Mozilla Firefox';
        }
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE){
        	return 'Google Chrome';
        }
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE){
        	return "Opera Mini";
        }
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE){
        	return "Opera";
        }
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE){
        	return "Safari";
        }
    }
}
