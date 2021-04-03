<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\StatDetail;
use Image;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Models\Role;

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
                $nestedData['actions'] = '<a href="/players/'.$player->id.'/edit" class="btn btn-primary btn-sm">Edit</a>&nbsp;'
                        . '<a href="/players/'.$player->id.'" class="btn btn-primary btn-sm">Details</a>';
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
        $roles = Role::where('id','!=',1)->get();
        return view('players.create',compact('roles'));
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

        $input['role_id'] = config('constants.roles.player');
        
        $result = User::addUser($input);
        
        $result = Player::addPlayer($input,$result->id,true);
        
        if(isset($result->id)){
            return redirect('/players')->with('success', 'Player created successfully!');
        }else{
            return back()->withInput()->with('error', 'Something went wront while creating new player!');
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
        $player = Player::with('user')->find($id);
        $roles = Role::where('id','!=',1)->get();
        return view('players.edit',compact('player','id','roles'));
    }

    
    public function update(Request $request, $id)
    {
        //
        $player = Player::find($id);
        if ($player) {
            $input = $request->except('_token','_method');
            if ($request->hasFile('image')) {
                $basePath = 'images/players/';
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $input['image_path'] = $basePath . $fileName;
                $img = Image::make($image->getRealPath());
                Storage::disk('local')->put('public/' . $basePath . '/' . $fileName, $img->stream(), 'public');
            }

            $updateUserRes = User::updateUser($input,$player->fk_user);

            $updatePlayerRes = Player::updatePlayer($input, $player->id);

            return redirect('/players')->with('success', 'Player updated successfully!');
            
        } else {
            return redirect('/players')->with('error', 'Player not found against the provided ID!');
        }
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
