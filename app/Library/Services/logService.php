<?php

namespace App\Library\Services;
use App\Library\Contracts\logContract;
use App\models\logdata\log;

class logService implements logContract {
	public function logHistory(){
		return log::logHistory();
	}
} 