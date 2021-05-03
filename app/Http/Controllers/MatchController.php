<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Match;
use App\Models\MatchDetail;
use App\Models\Player;
use App\Models\MatchStatDetail;
use DB;

class MatchController extends Controller {

    public function index() {
        return view('matches.list');
    }

    public function allMatches(Request $request) {

        $input = $request->all();
        $limit = $request->input('length');
        $start = $request->input('start');

        $data = array();

        $matches = Match::totalMatches($input)->offset($start)
                ->limit($limit)
                ->get();


        if (!empty($matches)) {
            foreach ($matches as $match) {
                $nestedData['match_id'] = $match->id;
                $nestedData['match_name'] = $match->name;
                $nestedData['team_1'] = $match->team1->name;
                $nestedData['team_2'] = $match->team2->name;
                $nestedData['match_date'] = date("Y-m-d H:i", strtotime($match->match_date));
                $nestedData['actions'] = '<a href="/matches/' . $match->id . '" class="btn btn-primary btn-sm">Details</a> &nbsp;'
                        . '<a href="/upload_match_stats/' . $match->id . '" class="btn btn-primary btn-sm">Upload Player Stats</a>&nbsp;';
                        //. '<a href="/delete_whole_match/' . $match->id . '" onclick="return confirm(\'Are you sure you want to delete whole match ?\')" class="btn btn-primary btn-sm">Delete Match</a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval(count($matches)),
            "recordsFiltered" => intval(count($matches)),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    public function create() {
        $teams = Team::get()->toArray();
        return view('matches.create', compact('teams'));
    }

    public function store(Request $request) {

        $match = Match::addMatch($request->all());

        if (isset($match['id'])) {

            $matchId = $match['id'];

            if ($request->hasFile('file_team1_period1')) {

                $path = $request->file('file_team1_period1')->getRealPath();
                $data = array_map('str_getcsv', file($path));
                $this->uploadFile($matchId, $data, 1,$request->get('first_team'));
            }
            if ($request->hasFile('file_team1_period2')) {

                $path = $request->file('file_team1_period2')->getRealPath();
                $data = array_map('str_getcsv', file($path));
                $this->uploadFile($matchId, $data, 2,$request->get('first_team'));
            }
            if ($request->hasFile('file_team2_period1')) {

                $path = $request->file('file_team2_period1')->getRealPath();
                $data = array_map('str_getcsv', file($path));
                $this->uploadFile($matchId, $data, 1,$request->get('second_team'));
            }
            if ($request->hasFile('file_team2_period2')) {

                $path = $request->file('file_team2_period2')->getRealPath();
                $data = array_map('str_getcsv', file($path));
                $this->uploadFile($matchId, $data, 2,$request->get('second_team'));
            }

            return redirect('/matches')->with('status', 'New Match created successfully!');
        }

        return redirect('/matches')->with('error', 'New Match creating failed!');
    }

    public function show(Request $request, $id) {

        //$match = new Match();
        
        $matchDetails = Match::getMatchDetails($id);
        $overAllMatchPlayerDetailsTeam1 = MatchDetail::getMatchDetailsById($id,0,$matchDetails->first_team);
        //pd($overAllMatchPlayerDetailsTeam1);
        $overAllMatchPlayerDetailsTeam2 = MatchDetail::getMatchDetailsById($id,0,$matchDetails->second_team);
      
        $periodDetail['team_1']['period1'] = MatchDetail::getMatchDetailsById($id,1,$matchDetails->first_team);
        $periodDetail['team_1']['period2'] = MatchDetail::getMatchDetailsById($id,2,$matchDetails->first_team);
        
        $periodDetail['team_2']['period1'] = MatchDetail::getMatchDetailsById($id,1,$matchDetails->second_team);
        $periodDetail['team_2']['period2'] = MatchDetail::getMatchDetailsById($id,2,$matchDetails->second_team);

        $overallSummary['team_1'] = MatchDetail::getSummaryDeatilById($id,0,$matchDetails->first_team);
//        /pd($overallSummary);
        $overallSummary['team_2'] = MatchDetail::getSummaryDeatilById($id,0,$matchDetails->second_team);
        
        $periodSummary['team_1']['period1'] = MatchDetail::getSummaryDeatilById($id,1,$matchDetails->first_team);
        $periodSummary['team_1']['period2'] = MatchDetail::getSummaryDeatilById($id,2,$matchDetails->first_team);
        
        $periodSummary['team_2']['period1'] = MatchDetail::getSummaryDeatilById($id,1,$matchDetails->second_team);
        $periodSummary['team_2']['period2'] = MatchDetail::getSummaryDeatilById($id,2,$matchDetails->second_team);
        
        $data['individualPlayers']['team_1'] = MatchDetail::getMatchPlayers($id,$matchDetails->first_team);
        $data['individualPlayers']['team_2'] = MatchDetail::getMatchPlayers($id,$matchDetails->second_team);
        
        return view('matches.detail', compact('periodSummary','overallSummary','matchDetails', 'overAllMatchPlayerDetailsTeam1','overAllMatchPlayerDetailsTeam2', 'periodDetail','data'));
    }

    public function uploadFile($matchId, $data, $period, $teamId) {

        if (count($data) > 0) {

            $csvData = $this->getCSVData($data);

            if (count($csvData) > 0) {

                //Add in database    
                if (!empty($matchId)) {
                    $summary = 1;
                    foreach ($csvData as $da) {

                        $da['match_id'] = $matchId;
                        $da['team_id'] = $teamId;
                        $da['period'] = $period;

                        $player = Player::getOrCreatePlayer($da);
                        unset($da['player_no'], $da['name']);

                        if (isset($player->id)) {
                            $da['player_id'] = $player->id;
                            MatchDetail::createDetails($da);
                        } else {
                            $da['is_summary'] = $summary;
                            MatchDetail::createDetails($da);
                            $summary++;
                        }
                    }
                }
            }
        }
    }

    public function getCSVData($data) {

        $csvData = [];
        $iterator = 0;
        foreach ($data as $k => $d) {

            if ($k > 0) {

                $csvData[$iterator]['sensor'] = $d[1] ?? '';
                $csvData[$iterator]['player_no'] = $d[2] ?? '';
                //$csvData[$iterator]['name'] = $d[3] ?? '';
                $csvData[$iterator]['player_position'] = $d[4] ?? '';
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
        return $csvData;
    }

    public function uploadMatchStats($teamId) {

        $match = Match::find($teamId);
        return view('matches.match_stat_upload', compact('match'));
    }

    public function submitMatchStats(Request $request) {

        $inputs = $request->all();

        $matchId = $inputs['match_id'];

        //Sensor and player id mapping
        $sensorPlayerMapping = MatchDetail::getSensorPlayerMapping($matchId);

        if (isset($inputs['team_1_players']) && count($inputs['team_1_players']) > 0) {

            foreach ($inputs['team_1_players'] as $playerfile) {

                $path = $playerfile->getRealPath();

                $fileName = getFileNameFromFilePath($playerfile->getClientOriginalName());
                $playerId = isset($sensorPlayerMapping[$fileName]) ? $sensorPlayerMapping[$fileName] : 1;

                $playerRow = array_map('str_getcsv', file($path));

                $playerStat = $this->getPlayerCSVData($playerRow, $matchId, $playerId);
                if (count($playerStat) > 0) {
                    foreach (array_chunk($playerStat, 1000) as $t) {
                        MatchStatDetail::addBulkStat($t);
                    }
                }
            }
        }
        if (isset($inputs['team_2_players']) && count($inputs['team_2_players']) > 0) {

            foreach ($inputs['team_2_players'] as $playerfile) {

                $path = $playerfile->getRealPath();

                $fileName = getFileNameFromFilePath($playerfile->getClientOriginalName());
                $playerId = isset($sensorPlayerMapping[$fileName]) ? $sensorPlayerMapping[$fileName] : 1;

                $playerRow = array_map('str_getcsv', file($path));

                $playerStat = $this->getPlayerCSVData($playerRow, $matchId, $playerId);
                if (count($playerStat) > 0) {
                    foreach (array_chunk($playerStat, 1000) as $t) {
                        MatchStatDetail::addBulkStat($t);
                    }
                }
            }
        }

        return redirect('/matches')->with('success', 'Player stats uploaded successfully');
    }

    public function getPlayerCSVData($data, $matchId, $playerId) {

        $csvData = [];
        $iterator = 0;
        foreach ($data as $k => $d) {

            if ($k > 5) {

                $csvData[$iterator]['player_id'] = $playerId;
                $csvData[$iterator]['match_id'] = $matchId;
                $csvData[$iterator]['time_played'] = $d[0] ?? '';
                $csvData[$iterator]['x_position'] = $d[1] ?? '';
                $csvData[$iterator]['y_position'] = $d[2] ?? '';
                $csvData[$iterator]['lat'] = $d[3] ?? '';
                $csvData[$iterator]['long'] = $d[4] ?? '';
                $csvData[$iterator]['speed'] = $d[5] ?? '';
                $csvData[$iterator]['hr'] = $d[6] ?? '';
                $csvData[$iterator]['num_sat'] = $d[7] ?? '';
                $csvData[$iterator]['h_dop'] = $d[8] ?? '';

                $iterator++;
            }
        }
        return $csvData;
    }
    
    public function deleteWholeMatch($matchId) {
        
        DB::beginTransaction();
        
        try {
            $matchDetails = Match::find($matchId);
            if($matchDetails){
                //Delete player stats against this match
                MatchStatDetail::where('match_id',$matchId)->delete();
                
                //Delete match stats
                MatchDetail::where('match_id',$matchId)->delete();
                
                //Delete Match
               $matchDetails->delete();
               
               DB::commit();
               
               return redirect('/matches')->with('success', 'Match data deleted successfully');
            }else{
               return redirect('/matches')->with('error', 'Match details not found');
            }
        } catch (\Exception $e) {
            
            DB::rollback();
            //return $e->getMessage();
            return redirect('/matches')->with('error', 'Match data not deleted');
        }
    }

}