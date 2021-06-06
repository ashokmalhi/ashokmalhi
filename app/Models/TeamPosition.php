<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamPosition extends Model
{
    protected $table = 'team_position';
    
    protected $guarded = [];
    
    public static function createOrUpdate($position){
        
        $teamPosition = self::where('match_id',$position['match_id'])->where('team_id',$position['team_id'])->first();
        
        if($teamPosition){
            //If entry already exists,then update axis
            $teamPosition->x_axis = $position['x_axis'];
            $teamPosition->y_axis = $position['y_axis'];
            $teamPosition->save();
                    
        }else{
            //Create new
            self::create($position);
        }
    }
    
    public static function getPositionByTeam($matchId,$teamId){
        
        return self::where('match_id', $matchId)->where('team_id', $teamId)->first();
    }
    
}
