<?php
namespace App\Helpers;
use App\Jobs\apiMailJob;
use App\User;
use App\models\api\request;

class queueDispatch{
	public static function dispatch(){
		$requests = request::pendingRequests();
		foreach ($requests as $request) {
			apiMailJob::dispatch($request);
		}
	}
}