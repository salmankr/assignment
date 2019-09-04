<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'city', 'country_id', 'state_id', 'encrypted_key', 'api_key', 'owner_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country(){
        return $this->belongsTo('App\models\userdata\country','country_id');
    }

    public function state(){
        return $this->belongsTo('App\models\userdata\state','state_id');
    }

    public function payments(){
        return $this->HasOne('App\models\api\payment');
    }

    public static function APIsave($apiKey){
        $user = Auth::user();
        $user->forceFill([
            'api_token' => hash('sha256', $apiKey),
        ])->save();
        return true;
    }

    public static function passwordSave($password){
        $user = Auth::user();
        User::where('id', $user->id)->update(['password' => Hash::make($password)]);
    }

    public static function getUserVerified($email){
        return User::where('email', $email)->first();
    }

    public static function subUserSaveData($request){
        $userObj =new User;
        $userObj->name = $request->name;
        $userObj->email = $request->email;
        $userObj->password = Hash::make($request->password);
        $userObj->address = $request->address;
        $userObj->email_verified_at = Carbon::now();
        $userObj->city = $request->city;
        $userObj->country_id = $request->country;
        $userObj->state_id = $request->state;
        $userObj->owner_id = Auth::id();
        $userObj->save();
         $userObj->forceFill([
            'encrypted_key' => encrypt($userObj->id),
        ])->save();
        return $userObj->id;
    }

    public static function getPayment($user){
        //dd($user);
        if($user->owner_id == null){ 
            return User::where('id', $user->id)->first();
        }else{
            return User::where('id', $user->owner_id)->first();
        }
    }
}
