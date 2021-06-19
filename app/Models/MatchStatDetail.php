<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchStatDetail extends Model
{
    protected $fillable = ['match_id', 'player_id', 'team_id', 'time_played', 'time_mili_sec', 'x_position', 'y_position', 'lat', 'long', 'speed', 'hr', 'num_sat' ,'h_dop'];

    public static function addBulkStat($input){

        return MatchStatDetail::insert($input);
    }
    
    public static function getMaxSpeedLastEntryByPlayerID($matchId,$playerId){

        return MatchStatDetail::where('match_id',$matchId)
                            ->where('player_id',$playerId)
                            ->where('speed','>',25)
                            ->select('id')
                            ->orderBy('id','desc')
                            ->first();
    }
}
