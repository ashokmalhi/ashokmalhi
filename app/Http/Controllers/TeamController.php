<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamPlayer;
use App\Models\Player;
use Image;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        return view('teams.list');
    }

    public function allTeams(Request $request){

        $input = $request->all();
        $limit = $request->input('length');
        $start = $request->input('start');

        $data = array();
        
        $teams = Team::getAllTeams($input)->offset($start)
                ->limit($limit)
                ->get();
                    
        if(!empty($teams))
        {
            foreach ($teams as $team)
            {
                $nestedData['name'] = $team->name;
                $nestedData['image'] = "<img src='".asset('storage/'.$team->image)."' width=50 height=50>";
                $nestedData['action'] = '<a target="_blank" href="/teams/'.$team->id.'/edit" class="btn btn-primary btn-sm">Edit</a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval(count($teams)),
            "recordsFiltered" => intval(count($teams)),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function create()
    {
        $players = Player::join('users','fk_user', 'users.id')->where('user_type', 'p')->pluck('first_name','players.id')->toArray();
        $coaches = Player::join('users','fk_user', 'users.id')->where('user_type', 'c')->pluck('first_name','players.id')->toArray();
        $managers = Player::join('users','fk_user', 'users.id')->where('user_type', 'm')->pluck('first_name','players.id')->toArray();
        return view('teams.create',compact('players','coaches','managers'));
    }

  
    public function store(Request $request)
    {
        $input = $request->except('_token');
        
        if ($request->hasFile('image')) {
            $basePath = 'images/teams/';
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $input['image'] = $basePath.$fileName;
            $img = Image::make($image->getRealPath());
            Storage::disk('local')->put('public/'.$basePath.'/'.$fileName, $img->stream(), 'public');
        }
        
        $result = Team::addTeam($input);
        $result = TeamPlayer::addTeamPlayer($input,$result->id);
        if(isset($result->id)){
            return redirect('/teams')->with('status', 'Team created successfully!');
        }else{
            return back()->withInput();
        }
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
        $players = Player::join('users','fk_user', 'users.id')->where('user_type', 'p')->pluck('first_name','players.id')->toArray();
        $coaches = Player::join('users','fk_user', 'users.id')->where('user_type', 'c')->pluck('first_name','players.id')->toArray();
        $managers = Player::join('users','fk_user', 'users.id')->where('user_type', 'm')->pluck('first_name','players.id')->toArray();
        $team = Team::with('teamPlayer')->find($id);
        return view('teams.edit',compact('players','coaches','managers','team'));
    }

    
    public function update(Request $request)
    {
        $input = $request->except('_token');
        
        if ($request->hasFile('image')) {
            $basePath = 'images/teams/';
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $input['image'] = $basePath.$fileName;
            $img = Image::make($image->getRealPath());
            Storage::disk('local')->put('public/'.$basePath.'/'.$fileName, $img->stream(), 'public');
        }
        
        $result = Team::updateTeam($input,$input['id']);
        $result = TeamPlayer::addTeamPlayer($input,$input['id']);
        if(isset($result->id)){
            return redirect('/teams')->with('status', 'Team updated successfully!');
        }else{
            return back()->withInput();
        }
    }

    
    public function destroy($id)
    {
        //
    }
}
