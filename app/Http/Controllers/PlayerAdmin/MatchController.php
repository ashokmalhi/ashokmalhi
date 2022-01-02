<?php

namespace App\Http\Controllers\PlayerAdmin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\IntensityTime;
use App\Models\MatchDetail;
use App\Models\MatchStatDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Player;

class MatchController extends Controller
{

    public function index(Request $request,$matchId){

        $player = Auth::user();
        $allStats = $this->getStats($matchId);

        $topStats = $allStats['stats'];
        $playerStats = $allStats['getStats'];
        return view('player_admin.match',compact('player','topStats','playerStats'));
    }


    public function getMinByInterval(Request $request,$matchId,$teamId = NULL)
    {
        $player = Auth::user();
        $DistByMin = MatchStatDetail::getIntervalByMinute($player->id,$matchId);

        return ($DistByMin);
    }

    public function getHeatMapData(Request $request,$matchId,$period = 1){

        $player = Auth::user();

        $totalPoints = MatchStatDetail::where('match_id', $matchId)->where('player_id',$player->id)->count();

        $eachPeriod = ceil($totalPoints / 2);

        if($period == 1){
            $heatMapCoordinates['period'] = MatchStatDetail::where('match_id', $matchId)->where('player_id',$player->id)->skip(0)->take($eachPeriod)->get();

        }elseif($period == 2){
            $heatMapCoordinates['period'] = MatchStatDetail::where('match_id', $matchId)->where('player_id',$player->id)->skip($eachPeriod)->take($totalPoints)->get();

        }

        return $heatMapCoordinates['period']->map->only('lat','lng');
    }

    public function getIntensityStats(Request $request,$matchId){
        $player = Auth::user();

        //$intensityTime = IntensityTime::where('player_id', $player->id)->where('match_id', $matchId)->get();
        $result = array();
        $response = array(
            'label'=>array('00:00','00:05','00:10','00:15', '00:20', '00:25', '00:30', '00:35', '00:40', '00:45', '00:50', '00:55'),
            'value'=>array(0,0,0,0,0,0,0,0,0,0,0,0)
        );

        $count1 = 7;
        $results = IntensityTime::select(\DB::raw('distance_covered as value'),
            \DB::raw('(CASE WHEN intensity_time.time_range = "0-5" THEN "00:00"
                                WHEN intensity_time.time_range = "5-10" THEN "00:05"
                                WHEN intensity_time.time_range = "10-15" THEN "00:10"
                                WHEN intensity_time.time_range = "15-20" THEN "00:15"
                                WHEN intensity_time.time_range = "20-25" THEN "00:20"
                                WHEN intensity_time.time_range = "25-30" THEN "00:25"
                                WHEN intensity_time.time_range = "30-35" THEN "00:30"
                                WHEN intensity_time.time_range = "35-40" THEN "00:35"
                                WHEN intensity_time.time_range = "40-45" THEN "00:40"
                                WHEN intensity_time.time_range = "45-50" THEN "00:45"
                                WHEN intensity_time.time_range = "50-55" THEN "00:50"
                                END) AS label'))->where('player_id', $player->id)->get()->toArray();


        if(count($results) > 0){
            foreach ($results as $key => $value) {
                // if($value['label'] = '00:35'){
                //     dd(in_array($value['label'],$response['label']));
                // }
                if(in_array($value['label'],$response['label'])){
                    $key = array_search($value['label'],$response['label']);
                    $response['value'][$key] = $value['value'];
                }
                // $response['label'][$key] = $value['label'] ;
                // $response['value'][$key] = $value['value'];
            }
        }
        // array_push($result,$label);
        //array_push($result,$response);
        return $response;
    }



    public function getStats($matchId){


        $getStats = MatchDetail::getMatchPlayers($matchId,null,Auth::user()->id);
        $stats = [];

        if(isset($getStats->matchStats)){
            $stats['totalTimePlayed'] = '00:00:00';
            $stats['totalDistance'] = $stats['noOfAcceleration1'] = $stats['noOfAcceleration2'] = 0;
            $stats['noOfDeceleration1'] = $stats['noOfDeceleration2'] = $stats['noOfSprints'] = $stats['hidDistance'] = 0;
            $stats['avgSpeed'] = $stats['maxSpeed'] = $stats['maxAcceleration'] = 0;
            $stats['distanceSpeedRange15'] = $stats['distanceSpeedRange15_20'] = $stats['distanceSpeedRange20_25'] = $stats['distanceSpeedRange25_30'] = $stats['distanceSpeedRangeGreater_30'] = 0;

            foreach ($getStats->matchStats as $stat) {

                $secs = strtotime($stats['totalTimePlayed']) - strtotime("00:00:00");
                $stats['totalTimePlayed'] = date("H:i:s", strtotime($stat->time_played) + $secs);

                $stats['totalDistance'] += $stat->distance_km;
                $stats['noOfAcceleration1'] += $stat->no_of_acceleration_3;
                $stats['noOfAcceleration2'] += $stat->no_of_acceleration_4;
                $stats['noOfDeceleration1'] += $stat->no_of_deceleration_3;
                $stats['noOfDeceleration2'] += $stat->no_of_deceleration_4;
                $stats['noOfSprints'] += $stat->no_of_sprint_greater_25_km;
                $stats['hidDistance'] += $stat->hid_distance_15_km;
                $stats['avgSpeed'] += $stat->avg_speed_km;
                if($stat->max_speed_km > $stats['maxSpeed']){
                    $stats['maxSpeed'] = $stat->max_speed_km;
                }
                if($stat->max_acceleration > $stats['maxAcceleration']){
                    $stats['maxAcceleration'] = $stat->max_acceleration;
                }

                $stats['distanceSpeedRange15'] += $stat->distance_speed_range_15_km;
                $stats['distanceSpeedRange15_20'] += $stat->distance_speed_range_15_20_km;
                $stats['distanceSpeedRange20_25'] += $stat->distance_speed_range_20_25_km;
                $stats['distanceSpeedRange25_30'] += $stat->distance_speed_range_25_30_km;
                $stats['distanceSpeedRangeGreater_30'] += $stat->distance_speed_range_greater_30_km;
            }
        }

        return ['getStats'=>$getStats,'stats'=>$stats];
    }
}
