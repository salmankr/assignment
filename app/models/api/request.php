<?php

namespace App\models\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class request extends Model
{
    protected $fillable = ['status_id'];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public static function saveData($request){
    	$requestObj = new request;
    	$requestObj->user_id = $request->user()->id;
    	$requestObj->status_id = 1;
    	$requestObj->from = $request->data['from'];
    	$requestObj->to = $request->data['to'];
    	$requestObj->cc = $request->data['cc'];
    	$requestObj->bcc = $request->data['bcc'];
    	$requestObj->subject = $request->data['subject'];
    	$requestObj->body = $request->data['body'];
    	$requestObj->reference = $request->reference;
    	$requestObj->webhook_url = $request->webhook_url;
    	$requestObj->raw_data = json_encode($request->all());
    	$requestObj->save();
    	return $requestObj;
    }

    public static function getReffEmail($reff){
        return request::where('reference', $reff)->first();
    }

    public static function pendingRequests(){
        return request::where('status_id', 1)->get();
    }
}
