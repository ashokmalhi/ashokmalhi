<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Stat;
use App\Models\StatDetail;
use App\Models\Player;

class StatsController extends Controller
{
    public function index()
    {
        return view('stats.list');
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
                        
                        if(isset($player->id)){
                            
                            unset($da['player_no'],$da['name']);
                            $da['stat_id'] = $statDetails['id'];
                            $da['player_id'] = $player->id;
                            
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
        
        echo $playerId;
        die;
    }
    
    public function showTeamStats($statId){
        
        echo $statId;
        die;
        
        return view('stats.team_stats');
    }
    
}
