<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MatchStatDetail extends Model
{
    protected $fillable = ['match_id', 'player_id', 'team_id', 'time_played', 'time_mili_sec', 'x_position', 'y_position', 'lat', 'long', 'speed', 'hr', 'num_sat' ,'h_dop'];

    protected $appends = ['time_played_date','lng'];

    public static function addBulkStat($input){

        return MatchStatDetail::insert($input);
    }

    public function getTimePlayedDateAttribute(){
        return Carbon::parse($this->time_played)->toDateString();

    }

    public function getLngAttribute(){
        return $this->long;

    }

    public static function getMaxSpeedLastEntryByPlayerID($matchId,$playerId){

        return MatchStatDetail::where('match_id',$matchId)
                            ->where('player_id',$playerId)
                            ->where('speed','>',25)
                            ->select('id')
                            ->orderBy('id','desc')
                            ->first();
    }


    public static function getIntervalByMinute($playerId = NULL,$matchId = NULL){

        $dt = self::where('match_id','=',$matchId)->where('player_id','=',$playerId)->get();
        // grouping into minute
        $byMinDt = $dt->chunk(600);

        $distanceByMin = [];

        //now iterate to get distance in kms between first and last array (lat & long)
        foreach ($byMinDt as $key=>$item){

            //chunking into 2
            $chunks = $item->chunk(2);

            $calculatedDistance = 0;
            foreach ($chunks as $k=>$val){
                $firstArr = $val->first();
                $lastArr = $val->last();
                $distance = getDistanceBetweenPointsNew($firstArr->lat,$firstArr->long,$lastArr->lat,$lastArr->long,'meters');
                $calculatedDistance += $distance;
            }
            $distanceByMin[$key+1] = round($calculatedDistance,2);
        }
        return $distanceByMin;

    }

    public static function getIntervalByDate($playerId = NULL,$matchId = NULL){

        $dt = self::where('player_id','=',$playerId)->get();
        // grouping into minute
        $byDate = $dt->groupBy('time_played_date');

        $distanceByDate = [];

        //now iterate to get distance in kms between first and last array (lat & long)
        foreach ($byDate as $key=>$item){

            //chunking into 2
            //chunking into 2
            $chunks = $item->chunk(2);

            $calculatedDistance = 0;
            foreach ($chunks as $k=>$val){
                $firstArr = $val->first();
                $lastArr = $val->last();
                $distance = getDistanceBetweenPointsNew($firstArr->lat,$firstArr->long,$lastArr->lat,$lastArr->long,'meters');
                $calculatedDistance += $distance;
            }
            $distanceByDate[$key] = round($calculatedDistance,2);
        }
        return $distanceByDate;

    }

}
