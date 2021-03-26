<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use LaravelEntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type','role_id','email_verified_at'
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


    public static function addUser($input){
        $user = self::create([
            'name' => $input['first_name'].' '.$input['last_name'],
            'email'  => $input['email'],
            'password'  => Hash::make('123456'),
            'role_id'  => $input['role_id'],
            //'user_type' => $input['type']
        ]);
        
        if($user){
            //Attach user and role
            $user->roles()->attach($input['role_id']);
        }
        return $user;

    }
    public static function updateUser($input,$userId){
        
        $user = User::find($userId);
        if($user){
            $user->name = $input['first_name'].' '.$input['last_name'];
            $user->email = $input['email'];
            $user->save();
        }
        
        return $user;

    }
    public static function updatePassword($input){
        $user = User::where('email',$input['email'])->first();
        if(!empty($user)){
            User::where('email', $input['email'])->update(['password'=>Hash::make($input['password']), 'email_verified_at' => now()]);
            return true;
        }
        return false;
    }

    public static function checkIfUserExists($email){
        return self::where('email',$email)->first();
    }
}
