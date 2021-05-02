<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class MatchDetail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'match_id', 'team_id', 'player_id' ,'sensor', 'time_played','distance_km', 'hid_distance_15_km', 'distance_speed_range_15_km',
        'distance_speed_range_15_20_km', 'distance_speed_range_20_25_km', 'distance_speed_range_25_30_km',
        'distance_speed_range_greater_30_km','no_of_sprint_greater_25_km','avg_speed_km','max_speed_km','max_acceleration',
        'no_of_acceleration_3','no_of_acceleration_4','no_of_deceleration_3','no_of_deceleration_4','is_summary','period'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];

    public function players(){
        return $this->belongsTo('App\Models\Player','player_id','id');
    }
    
    public static function createDetails($input){
        
        return self::create($input);
    }

    public static function getStatDetailByTeamId($statId){
        
        return self::with('players')->where('stat_id', $statId);
    }
    
    public static function getStatDetailByPlayerId($playerId){
        
        return self::where('player_id', $playerId)->first();
    }
    
    public static function getSensorPlayerMapping($matchId){
        
        return self::where('match_id', $matchId)->where('sensor','>',0)
                ->groupBy('sensor','player_id')
                ->orderBy('sensor')
                ->pluck('player_id','sensor');
    }
    
    public static function getMatchDetailsById($id, $period=0, $teamId = 0){
        $query = self::select('player_id','sensor', DB::raw("TIME_FORMAT(SEC_TO_TIME( SUM( TIME_TO_SEC( `time_played` ) ) ), '%H:%i:%s' ) as time_played"),
        DB::raw("SUM(distance_km) as distance_km"),
        DB::raw("SUM(hid_distance_15_km) as hid_distance_15_km"),
        DB::raw("SUM(distance_speed_range_15_km) as distance_speed_range_15_km"),
        DB::raw("SUM(distance_speed_range_15_20_km) as distance_speed_range_15_20_km"),
        DB::raw("SUM(distance_speed_range_20_25_km) as distance_speed_range_20_25_km"),
        DB::raw("SUM(distance_speed_range_25_30_km) as distance_speed_range_25_30_km"))
        ->with('players')->where('match_id', $id)->where('is_summary', 0);
        if($period){
            $query = $query->where('period', $period);
        }
        if($teamId){
            $query = $query->where('team_id', $teamId);
        }
        return $query->groupBy('player_id')->orderBy('player_id', 'DESC')->get()->toArray();
    }
    
        public static function getMatchDetailsByPeriodById($id, $period=0){
        $query = self::select('player_id','sensor', "time_played","distance_km","hid_distance_15_km","distance_speed_range_15_km","distance_speed_range_15_20_km","distance_speed_range_20_25_km","distance_speed_range_25_30_km")
                ->with('players')
                ->where('match_id', $id);
        if($period){
            $query = $query->where('period', $period);
        }
        return $query->get();
    }

    public static function getSummaryDeatilById($id, $period=0, $teamId=0){
        $query = self::select('is_summary','player_id','sensor', DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC( `time_played` ) ) ) as time_played"),
        DB::raw("SUM(distance_km) as distance_km"),
        DB::raw("SUM(hid_distance_15_km) as hid_distance_15_km"),
        DB::raw("SUM(distance_speed_range_15_km) as distance_speed_range_15_km"),
        DB::raw("SUM(distance_speed_range_15_20_km) as distance_speed_range_15_20_km"),
        DB::raw("SUM(distance_speed_range_20_25_km) as distance_speed_range_20_25_km"),
        DB::raw("SUM(distance_speed_range_25_30_km) as distance_speed_range_25_30_km"))->whereNull('player_id')->where('match_id', $id);
        if($period){
            $query = $query->where('period', $period);
        }
        if($teamId){
            $query = $query->where('team_id', $teamId);
        }
        return $query->groupBy('is_summary')->orderBy('is_summary', 'ASC')->orderBy('id', 'DESC')->get();
    }
    
    public function matchStats(){
        return $this->hasMany('App\Models\MatchDetail','player_id','player_id');
    }
    
    public static function getMatchPlayers($matchId,$teamId){
        
        return self::with(['matchStats'])
                ->join('players as p','p.id','match_details.player_id')
                ->select('p.id as player_id','p.first_name','p.last_name')
                ->where('match_details.match_id',$matchId)
                ->where('team_id',$teamId)
                ->groupBy('match_details.player_id')
                ->get();
    }
}
