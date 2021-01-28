<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamPlayer;
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
        //
        return view('teams.create');
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
