<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = [
        'email', 'token'
    ];
    public $timestamps = false;

    public static function createToken($email){
        $data= [
            'email' => $email,
            'token' => uniqid()
        ];
        $password_reset = self::create($data);
        return $password_reset;
    }
}
