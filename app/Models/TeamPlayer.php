<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

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
            if(in_array($member,$input['coach']) == 1){
                $coach = 1;
            }else{
                $coach = 0;
            }

            if(in_array($member,$input['manager']) == 1){
                $manager = 1;
            }else{
                $manager = 0;
            }
            $team_player = self::create([
                "player_id" => $member,
                "team_id" => $team_id,
                "match_id" => 1,
                "sensor_id" => 1,
                "sensor_no" => "1",
                "position" => "1",
                "is_coach" =>$coach,
                "is_manager" => $manager
            ]);
        }

        return $team_player;
    }
}
