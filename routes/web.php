<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if(Illuminate\Support\Facades\Auth::check()){
		$log = App\models\logdata\log::saveData(7);	
	}
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/states/{id}', 'userDataController@states');

Route::middleware('auth')->group(function(){
	Route::get('/localization/{locale}', 'userDataController@localization')->name('localization');
	Route::name('change.')->middleware('emailVerified', 'subUser')->group(function(){
		Route::get('/password-change', 'userDataController@changePasswordView')->name('view');
		Route::post('/password-change', 'userDataController@changePasswordSave')->name('save');
	});
	Route::middleware('emailVerified', 'subUser')->group(function(){
		Route::get('/logs', 'logsDataController@index')->name('logsView');
		Route::get('/api-key-generation', 'userDataController@apiKeys')->name('api');
		Route::get('/register/sub-user', 'merchantController@userFormView')->name('userFormView');
		Route::post('/register/sub-user', 'merchantController@userFormSubmit')->name('userFormSubmit');
	});
});