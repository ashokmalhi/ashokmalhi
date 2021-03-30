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
            self::where('team_id',$team_id)->delete();

            foreach($input['player_ids'] as $key => $member){
                if($member != ""){
                    $role_id = isset($input['role'][$key])?$input['role'][$key]:0;
                    
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
            
            if(count($input['coach_ids']) > 0){
                foreach($input['coach_ids'] as $coach){
                   if($coach != ""){
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
        return $team_player;
    }
}
