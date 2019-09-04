<?php

namespace App\Http\responses;
use Illuminate\Support\Facades\Response;

class apiResponses
{
	public static function received(){
		return [
			'status' => 'received',
			'description' => 'Thanks! your email has been received',
		];
	}

	public static function proccessed(){
		return [
			'status' => 'proccessed',
			'description' => 'Thanks! your email has been proccessed',
		];
	}

	public static function error(){
		return [
			'status' => 'error',
			'error' => [
				'key' => 'invalid data',
				'message' => 'your provided data is invalid',
			],
		];
	}

	public static function response ($array, $code){
		return Response::Json([
			'status' => $array['status'],
			'error' => empty($array['error']) ? '' : [
				'key' => $array['error']['key'],
				'message' => $array['error']['message'],
			],
			'description' => empty($array['description']) ? '' : $array['description'],
		], $code);
	}
}