<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\StatDetail;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;

class PlayerController extends Controller
{
    public function index()
    {
//        $user = Auth::user();
//        pd($user);
        return view('players.list');
    }

    public function allPlayers(Request $request){

        $input = $request->all();
        $limit = $request->input('length');
        $start = $request->input('start');

        $data = array();
        
        $players = Player::totalPlayers($input)->offset($start)
                ->limit($limit)
                ->get();
                    
        if(!empty($players))
        {
            foreach ($players as $player)
            {
                $nestedData['player_name'] = $player->first_name .' '.$player->last_name;
                $nestedData['email'] = $player->email;
                $nestedData['mobile'] = $player->mobile;
                // $nestedData['player_name'] = $player->full_name;
                $nestedData['player_no'] = $player->player_no ?? "NA";
                $nestedData['height'] = $player->height ?? "NA";
                $nestedData['weight'] = $player->weight ?? "NA";
                $nestedData['max_heart_rate'] = $player->max_heart_rate ?? "NA";
                $nestedData['max_speed'] = $player->max_speed ?? "NA";
                $nestedData['actions'] = '<a target="_blank" href="/players/'.$player->id.'" class="btn btn-primary btn-sm">Details</a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval(count($players)),
            "recordsFiltered" => intval(count($players)),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function create()
    {
        //
        return view('players.create');
    }

  
    public function store(Request $request)
    {
        $this->validate($request, [
			'first_name'	=> 'required',
			'player_no'		=> 'required|unique:players,player_no',
			'email'			=> 'required|email|unique:users,email'
		]);
        $input = $request->except('_token');
        if ($request->hasFile('image')) {
            $basePath = 'images/players/';
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $input['image_path'] = $basePath.$fileName;
            $img = Image::make($image->getRealPath());
            Storage::disk('local')->put('public/'.$basePath.'/'.$fileName, $img->stream(), 'public');
        }

        $result = User::addUser($input);
        
        $result = Player::addPlayer($input,$result->id,true);
        
        if(isset($result->id)){
            return redirect('/players')->with('status', 'Player created successfully!');
        }else{
            return back()->withInput();
        }
    }

    
    public function show($id)
    {
        //
        $player = Player::find($id);
        $stat = StatDetail::getStatDetailByPlayerId($id);
        return view('players.detail',compact('player','stat'));
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
    
    public function uploadPlayers(Request $request)
    {
        
        if ($request->hasFile('file')){
            
            $path = $request->file('file')->getRealPath();
            $data = array_map('str_getcsv', file($path));
            
            if(count($data) > 0){
               
                foreach ($data as $k => $d){
                    
                    if($k > 0){
                        
                        $createPlayer['player_no'] = $d[0] ?? '';
                        $createPlayer['first_name'] = $d[1] ?? '';
                        $createPlayer['last_name'] = $d[2] ?? '';
                        // $createPlayer['full_name'] = $createPlayer['first_name'].' '.$createPlayer['last_name'];
                        $createPlayer['mobile'] = $d[3] ?? '';
                        $createPlayer['email'] = $d[4] ?? ''; 
                        if(!empty($createPlayer['email'])){
                            //pass an email to check if email already exists
                            $userExists = User::checkIfUserExists($createPlayer['email']);
                            if(!$userExists){
                                $exists = Player::checkIfAlreadyExists($createPlayer['email']);
                                $playerNo = Player::playerNoExists($createPlayer['player_no']);
                                if(!$exists && !$playerNo){
                                    $createPlayer['type'] = 'p';
                                    $user = User::AddUser($createPlayer);
                                    Player::addPlayer($createPlayer,$user->id,true);
                                }
                            }
                            
                        }
                    }
                }
            }
            return redirect('/players')->with('status', 'Players uploaded successfully!');
        }
        return view('players.upload');
        
    }
}
