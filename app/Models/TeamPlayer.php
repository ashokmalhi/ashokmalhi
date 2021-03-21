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
        self::where('team_id',$team_id)->delete();
        foreach($input['team_member'] as $member){
            $team_player = self::create([
                "player_id" => $member,
                "team_id" => $team_id,
                "match_id" => 1,
                "sensor_id" => 1,
                "sensor_no" => "1",
                "position" => "1"
            ]);
        }

        foreach($input['coach'] as $coach){
            $coach_player = self::where('player_id', $coach)->where('team_id',$team_id)->exists();
            if($coach_player){
                self::where('player_id', $coach)->where('team_id',$team_id)->update(['is_coach'=>1]);
            }else{
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

        foreach($input['manager'] as $manager){
            $manager_player = self::where('player_id', $manager)->where('team_id',$team_id)->exists();
            if($manager_player){
                self::where('player_id', $manager)->where('team_id',$team_id)->update(['is_manager'=>1]);
            }else{
                $team_player = self::create([
                    "player_id" => $manager,
                    "team_id" => $team_id,
                    "match_id" => 1,
                    "sensor_id" => 1,
                    "sensor_no" => "1",
                    "position" => "1",
                    "is_manager" => 1
                ]);
            }
        }

        return $team_player;
    }
}
