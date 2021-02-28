<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\StatDetail;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
                //$nestedData['player_name'] = $player->first_name .' '.$player->last_name;
                $nestedData['player_name'] = $player->full_name;
                //$nestedData['email'] = $player->email ?? "NA";
                $nestedData['height'] = $player->height ?? "NA";
                $nestedData['weight'] = $player->weight ?? "NA";
                $nestedData['max_heart_rate'] = $player->max_heart_rate ?? "NA";
                $nestedData['max_speed'] = $player->max_speed ?? "NA";
                $nestedData['actions'] = '<a target="_blank" href="/players/'.$player->id.'" class="btn btn-primary btn-sm">View Details</a>';
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
        $input = $request->except('_token');
        if ($request->hasFile('image')) {
            $basePath = 'images/players/';
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $input['image_path'] = $basePath.$fileName;
            $img = Image::make($image->getRealPath());
            Storage::disk('local')->put('public/'.$basePath.'/'.$fileName, $img->stream(), 'public');
        }
        
        $result = Player::addPlayer($input);
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
}
