<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stat;
use App\Models\StatDetail;
use App\Models\Player;
use App\Models\MatchStatDetail;
use App\Models\MatchDetail;
use App\Models\TeamPlayer;
use App\Models\IntensityTime;
use App\Models\DistancePerZone;
use DB;

class StatsController extends Controller
{
    public function index()
    {
        return view('stats.list');
    }
    
    public function calculateFinalStats($matchId,$teamId){
        
        $teamPlayers = TeamPlayer::getTeamPlayersByMatchIdAndTeamId($matchId,$teamId);
        
        //pd($teamPlayers);
        
        if(count($teamPlayers) > 0){
        
            $zones = calculateZones(112,71); //Team1
            //$zones = calculateZones(105,65); //Team2
            
            foreach ($teamPlayers as $playerId){
                
                $statDetails = MatchStatDetail::where('match_id',$matchId)
                                ->where('player_id',$playerId)
                                ->select('time_played','lat','long','x_position','y_position')
                                ->get()
                                ->toArray();

                $time = 0;
                $fiveMinInternal = [];
                $distance = 0;
                
                $zoneViseDistance = [];
                
                foreach($statDetails as $key => $detail){

                    if(!$time){
                        $time = $detail['time_played'];
                    }else{

                        $from_time = strtotime($time);
                        $to_time = strtotime($detail['time_played']);
                        $minutes = round(abs($to_time - $from_time) / 60,2);

                        if($minutes >= 5.00){
                            $fiveMinInternal[] = $distance;
                            $distance = 0;
                            $time = 0;
                            $calculatedDistance = 0;
                        }else{
                            $lat1 = $detail['lat'];
                            $long1 = $detail['long'];
                            $lat2 = isset($statDetails[$key+1]['lat'])?$statDetails[$key+1]['lat']:0;
                            $long2 = isset($statDetails[$key+1]['long'])?$statDetails[$key+1]['long']:0;
                            if($lat2 && $long2){
                                $calculatedDistance = getDistanceBetweenPointsNew($lat1,$long1,$lat2,$long2,'meters');
                                if(is_numeric($calculatedDistance) && !is_nan($calculatedDistance)){
                                    $distance = $distance + $calculatedDistance;
                                }
                            }else{
                                break;
                            }
                        }
                        //Save distance per zone
                        $zone = getZoneByPoint($detail['x_position'],$detail['y_position'],$zones);
                        if(isset($zoneViseDistance[$zone])){
                            $zoneViseDistance[$zone] = $zoneViseDistance[$zone] + $calculatedDistance;      
                        }else{
                             $zoneViseDistance[$zone] = $calculatedDistance;
                        }
                    }

                }
                
                
                //Store time and distance internal values
                $timeIntervals = getTimeIntervals();
                
                foreach($fiveMinInternal as $key => $distance){
                    
                    $intensityTime['match_id'] = $matchId;
                    $intensityTime['team_id'] = $teamId;
                    $intensityTime['player_id'] = $playerId;
                    $intensityTime['time_range'] = isset($timeIntervals[$key]) ? $timeIntervals[$key] : 0;
                    $intensityTime['distance_covered'] = $distance;
                    if($intensityTime['time_range']){
                        IntensityTime::create($intensityTime);
                    }
                }
                
                //Distance Per Zone
                $distanceZone['match_id'] = $matchId;
                $distanceZone['team_id'] = $teamId;
                $distanceZone['player_id'] = $playerId;
                $distanceZone['distance_zone_a1'] = isset($zoneViseDistance['a1']) ? meterToKm($zoneViseDistance['a1']) : 0;
                $distanceZone['distance_zone_a2'] = isset($zoneViseDistance['a2']) ? meterToKm($zoneViseDistance['a2']) : 0;
                $distanceZone['distance_zone_b1'] = isset($zoneViseDistance['b1']) ? meterToKm($zoneViseDistance['b1']) : 0;
                $distanceZone['distance_zone_b2'] = isset($zoneViseDistance['b2']) ? meterToKm($zoneViseDistance['b2']) : 0;
                $distanceZone['distance_zone_c1'] = isset($zoneViseDistance['c1']) ? meterToKm($zoneViseDistance['c1']) : 0;
                $distanceZone['distance_zone_c2'] = isset($zoneViseDistance['c2']) ? meterToKm($zoneViseDistance['c2']) : 0;
                
                DistancePerZone::create($distanceZone);
            }
        }
        echo "Stats calculation successfull";
        die;
    }
    
    public function allStats(Request $request){

        $input = $request->all();
        $limit = $request->input('length');
        $start = $request->input('start');

        $data = array();
        
        $stats = Stat::getAllStats($input)->offset($start)
                ->limit($limit)
                ->get();
                    
        if(!empty($stats))
        {
            foreach ($stats as $stat)
            {
                $nestedData['name'] = $stat->name;
                $nestedData['file_name'] = $stat->file_name;
                $nestedData['created_at'] = date('Y-m-d H:i',strtotime($stat->created_at));
                $nestedData['action'] = '<a target="_blank" href="/statistics/team/'.$stat->id.'" class="btn btn-primary btn-sm">Team Stats</a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval(count($stats)),
            "recordsFiltered" => intval(count($stats)),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    
    public function create()
    {
        return view('stats.create');
    }
  
    public function upload(Request $request)
    {
       //pd($input);
        if ($request->hasFile('file')){
            
            $path = $request->file('file')->getRealPath();
            $data = array_map('str_getcsv', file($path));
            
            if(count($data) > 0){
                $csvData = [];
                
                $iterator = 0;
                foreach ($data as $k => $d){
                    
                    if($k > 0){
                        
                        $csvData[$iterator]['sensor'] = $d[1] ?? '';
                        $csvData[$iterator]['player_no'] = $d[2] ?? '';
                        $csvData[$iterator]['name'] = $d[3] ?? '';
                        $csvData[$iterator]['time_played'] = $d[5] ?? '';
                        $csvData[$iterator]['distance_km'] = $d[6] ?? '';
                        $csvData[$iterator]['hid_distance_15_km'] = $d[7] ?? '';
                        $csvData[$iterator]['distance_speed_range_15_km'] = $d[8] ?? '';
                        $csvData[$iterator]['distance_speed_range_15_20_km'] = $d[9] ?? '';
                        $csvData[$iterator]['distance_speed_range_20_25_km'] = $d[10] ?? '';
                        $csvData[$iterator]['distance_speed_range_25_30_km'] = $d[11] ?? '';
                        $csvData[$iterator]['distance_speed_range_greater_30_km'] = $d[12] ?? '';
                        $csvData[$iterator]['no_of_sprint_greater_25_km'] = $d[13] ?? '';
                        $csvData[$iterator]['avg_speed_km'] = $d[14] ?? '';
                        $csvData[$iterator]['max_speed_km'] = $d[15] ?? '';
                        $csvData[$iterator]['max_acceleration'] = $d[16] ?? '';
                        $csvData[$iterator]['no_of_acceleration_3'] = $d[17] ?? '';
                        $csvData[$iterator]['no_of_acceleration_4'] = $d[18] ?? '';
                        $csvData[$iterator]['no_of_deceleration_3'] = $d[19] ?? '';
                        $csvData[$iterator]['no_of_deceleration_4'] = $d[20] ?? '';
                        
                        $iterator++;                        
                    }
                }
            }
            
            //Add in database
            if(count($csvData) > 0){
                
                $stat['name'] = $request->get('name');
                $stat['file_name'] = $request->file('file')->getClientOriginalName();
                
                $statDetails = Stat::addStat($stat);
               
                if(isset($statDetails['id'])){
                    
                    foreach ($csvData as $da){
                  
                        $player = Player::getOrCreatePlayer($da);
                        
                        $da['stat_id'] = $statDetails['id'];
                        
                        if(isset($player->id)){
                            unset($da['player_no'],$da['name']);
                            $da['player_id'] = $player->id;
                            StatDetail::createDetails($da);
                        }else{
                            unset($da['player_no'],$da['name']);
                            $da['is_summary'] = true;
                            StatDetail::createDetails($da);
                        }
                    }
                    
                }
                
            }
            return redirect('/statistics')->with('status', 'Stats created successfully!');
        }else{
            return redirect('/statistics/create')->with('status', 'Stats creating failed!');
        }
    }
    
    public function showPlayerStats($playerId){
        
        return view('players.detail');
        echo $playerId;
        die;
    }
    
    public function showTeamStats($statId){
        $team_player = StatDetail::getStatDetailByTeamId($statId)->get();
        return view('stats.stats', compact('statId', 'team_player'));
    }
    public function allTeamStats(Request $request){

        $input = $request->all();
        $limit = $request->input('length');
        $start = $request->input('start');

        $data = array();
        
        $stat_details = StatDetail::getStatDetailByTeamId($input['team_id'])->offset($start)
                ->limit($limit)
                ->get();

        if(!empty($stat_details))
        {
            foreach ($stat_details as $stat)
            {
               
                $nestedData['sensor'] = $stat->players->sensor_no;
                $nestedData['player_no'] = $stat->players->player_no;
                $nestedData['player_name'] = $stat->players->first_name.' '.$stat->players_last_name;
                $nestedData['player_position'] = $stat->players->position;
                $nestedData['time_played'] = $stat->time_played;
                $nestedData['distance'] = $stat->distance_km;
                $nestedData['hid_distance'] = $stat->hid_distance_15_km;
                $nestedData['distance_speed_range_0'] = $stat->distance_speed_range_15_km;
                $nestedData['distance_speed_range_15'] = $stat->distance_speed_range_15_20_km;
                $nestedData['distance_speed_range_25'] = $stat->distance_speed_range_20_25_km;
                // $nestedData['distance_speed_range_30'] = $stat->distance_speed_range_25_30_km;
                // $nestedData['distance_speed_range_greater_30'] = $stat->distance_speed_range_greater_30_km;
                // $nestedData['no_of_spririts'] = $stat->no_of_spirits_greater_25_km;
                // $nestedData['avg_speed'] = $stat->avg_speed_km;
                // $nestedData['max_speed'] = $stat->max_speed_km;
                // $nestedData['max_acceleration'] = $stat->max_acceleration;
                // $nestedData['no_of_accelerations_3'] = $stat->no_of_acceleration_3;
                // $nestedData['no_of_accelerations_4'] = $stat->no_of_acceleration_4;
                // $nestedData['decelerations_3'] = $stat->no_of_deceleration_3;
                // $nestedData['decelerations_4'] = $stat->no_of_deceleration_4;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval(count($stat_details)),
            "recordsFiltered" => intval(count($stat_details)),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function getPlayerStats(){
        
        $result = array();
        $statId = request()->team;
        $statDetail = StatDetail::getStatDetailByTeamId($statId)->get();
        foreach($statDetail as $key => $player){
            $response = array(
                'label'=>array('00:00','00:15','00:30','00:45', '01:00', '01:15'),
                'value'=>array(4,5,2,1,8,7)
                );
    
            array_push($result,$response);
        }
        return $result;
    }
    
}
