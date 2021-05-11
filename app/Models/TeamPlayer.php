<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Player;

class TeamPlayer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at',
    ];
    
    public static function addTeamPlayer($input,$team_id){
        
        if(count($input['player_ids']) > 0){
           
            foreach($input['player_ids'] as $key => $member){
                if($member != ""){
                    
                    $role_id = isset($input['role'][$key])?$input['role'][$key]:0;
                    $player = self::where('player_id',$member)
                                  ->where('team_id',$team_id)
                                  ->where('is_manager',($role_id == 2) ? 1 : 0)
                                  ->where('is_coach',0)->first();
                    if(!$player){
                        $team_player = self::create([
                            "player_id" => $member,
                            "team_id" => $team_id,
                            "match_id" => 1,
                            "sensor_id" => 1,
                            "sensor_no" => "1",
                            "position" => "1",
                            "is_manager" => ($role_id == 2) ? 1 : 0
                        ]);
                    } 
                }
            }
            
            if(isset($input['coach_ids']) && count($input['coach_ids']) > 0){
                foreach($input['coach_ids'] as $coach){
                   if($coach != ""){
                    $team_coach = self::where('player_id',$member)
                                  ->where('team_id',$team_id)
                                  ->where('is_coach',1)->first();
                    if(!$team_coach){
                        $team_player = self::create([
                            "player_id" => $coach,
                            "team_id" => $team_id,
                            "match_id" => 1,
                            "sensor_id" => 1,
                            "sensor_no" => "1",
                            "position" => "1",
                            "is_coach" => 1
                        ]);
                    }
                        
                   }
                }
            }
        }
        return true;
    }
    
    public function player(){
        return $this->belongsTo('App\Models\Player','player_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','fk_user','id');
    }

    public static function removeMembers($ids){
        self::whereIn('id', $ids)->delete();
    }
    
    public static function getTeamPlayersByMatchIdAndTeamId($matchId,$teamId){
        
        return MatchDetail::where('match_id',$matchId)
                        ->where('team_id',$teamId)
                        ->whereNotNull('player_id')
                        ->groupBy('player_id')
                        ->pluck('player_id')
                        ->toArray();
        
    }

}
