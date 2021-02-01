<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','email','player_no', 'date_of_birth', 'image_path','gender', 'height', 'weight',
        'max_heart_rate','target_heart_rate','max_speed','track_heart_rate', 'sensor_no', 'position'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at',
    ];
    
    public static function addPlayer($input){
        
        if(isset($input['track_heart_rate'])){
            $input['track_heart_rate'] = 1;
        }else{
            $input['track_heart_rate'] = 0;
        }
        $player = self::create($input);
        return $player;
    }
    
    public static function getOrCreatePlayer($input){
        
        $player = [];
        if(isset($input['name']) && !empty($input['name'])){
            $player = self::where('first_name', 'like', '%'.$input['name'].'%')->where('player_no',$input['player_no'])->first();
            if(!$player){
                $player = self::create([
                    'first_name' => $input['name'],
                    'last_name'  => $input['name'],
                    'player_no' => $input['player_no'],
                    'sensor_no' => $input['sensor'],
                    'position' => 0
                ]);
            }
        }
        return $player;
    }

    public static function totalPlayers($filter){
        
        return self::select("*")->orderBy('created_at', 'DESC');

    }
}
