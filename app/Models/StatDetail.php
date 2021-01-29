<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StatDetail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stat_id', 'player_id', 'sensor' ,'time_played','distance_km', 'hid_distance_15_km', 'distance_speed_range_15_km',
        'distance_speed_range_15_20_km', 'distance_speed_range_20_25_km', 'distance_speed_range_25_30_km',
        'distance_speed_range_greater_30_km','no_of_sprint_greater_25_km','avg_speed_km','max_speed_km','max_acceleration',
        'no_of_acceleration_3','no_of_acceleration_4','no_of_deceleration_3','no_of_deceleration_4'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at',
    ];
    
    public static function createDetails($input){
        
        return self::create($input);
    }

}
