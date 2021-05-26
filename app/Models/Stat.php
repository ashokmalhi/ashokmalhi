<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Models\IntensityTime;
use App\Models\DistancePerZone;

class Stat extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'file_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at',
    ];
    
    public static function addStat($input){
        
        return self::create($input);
    }
    
    public static function getAllStats($input){
        
        return self::select("*")->orderBy('created_at', 'DESC');
    }
    
    public static function deleteOldTeamStats($matchId,$teamId){
        
       IntensityTime::where('match_id',$matchId)->where('team_id',$teamId)->delete();
       DistancePerZone::where('match_id',$matchId)->where('team_id',$teamId)->delete();
    }
}
