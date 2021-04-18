<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Match;
use App\Models\StatDetail;
use App\Models\Player;

class MatchController extends Controller
{
    public function create(){
        $teams = Team::get()->toArray();
        return view('matches.create',compact('teams'));
    }

    public function store(Request $request)
    {   
       $match = new Match;
       $match = $match->addMatch($request->all());
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
                
              
                if(isset($match['id'])){
                    
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
        }
    }
}
