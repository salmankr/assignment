<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\models\api\request as requestModel;
use App\models\api\response;
use App\Http\Controllers\Controller;
use App\Http\Requests\apiEmailRequest;
use App\Http\Requests\apiEmailReffRequest;
use App\Http\responses\apiResponses;
use App\models\api\status;
use App\Helpers\queueDispatch;
use App\User;

class emailController extends Controller
{
    public function saveEmailRequest(apiEmailRequest $request){
    	$request->validated();
    	$payment = User::getPayment($request->user());
    	if($payment->payments->payment < 0.0489){
			$code = 400;
			$array = apiResponses::error();
    		return apiResponses::response($array, $code);
    	}
    	$savedObj = requestModel::saveData($request);
    	$status = status::getStatus($savedObj->status_id)->name;
    	$array = apiResponses::received();
    	$code = 201;
    	$response = apiResponses::response($array, $code);
    	response::saveData($array, $savedObj->id, $savedObj->status_id);
    	queueDispatch::dispatch();
    	return $response;
    }

    public function getEmailStatus(apiEmailReffRequest $request){
    	$request->validated();
    	$reffEmail = requestModel::getReffEmail($request->reference);
    	if($reffEmail === null){
    		$array = apiResponses::error();
    		$code = 404;
    		return apiResponses::response($array, $code);
    	}
    	$array = apiResponses::proccessed();
    	return apiResponses::response($array, 200);
    	// return apiResponses::response(status::getStatus($reffEmail->status_id)->name);
    }
}
