<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamPlayer;
use App\Models\Player;
use App\Models\Coach;
use Image;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller {

    public function index() {
        return view('teams.list');
    }

    public function allTeams(Request $request) {

        $input = $request->all();
        $limit = $request->input('length');
        $start = $request->input('start');

        $data = array();

        $teams = Team::getAllTeams($input)->offset($start)
                ->limit($limit)
                ->get();

        if (!empty($teams)) {
            foreach ($teams as $team) {
                $nestedData['name'] = $team->name;
                $nestedData['image'] = "<img src='" . asset('storage/' . $team->image) . "' width=50 height=50>";
                $nestedData['action'] = '<a href="/teams/' . $team->id . '/edit" class="btn btn-primary btn-sm">Edit</a>
                <a href="/teams/' . $team->id . '" class="btn btn-primary btn-sm">Show</a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval(count($teams)),
            "recordsFiltered" => intval(count($teams)),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    public function create() {
        $players = Player::getAllPlayers();
        $coaches = Coach::getAllCoaches();
        return view('teams.create', compact('players', 'coaches'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:teams,name',
                //'team_member'		=> 'required',
                //'coach'			=> 'required',
                // 'manager' => 'required'
                ], [
            'name.unique' => 'Team name already exists, Please try new'
        ]);
        $input = $request->except('_token');

        if ($request->hasFile('image')) {
            $basePath = 'images/teams/';
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $input['image'] = $basePath . $fileName;
            $img = Image::make($image->getRealPath());
            Storage::disk('local')->put('public/' . $basePath . '/' . $fileName, $img->stream(), 'public');
        }

        $result = Team::addTeam($input);
        $result = TeamPlayer::addTeamPlayer($input, $result->id);
        if ($result) {
            return redirect('/teams')->with('success', 'Team created successfully!');
        } else {
            return back()->withInput();
        }
    }

    public function show($id) {
        $team = Team::with('teamPlayer', 'teamPlayer.player')->find($id)->toArray();
        return view('teams.show', compact('team'));
    }

    public function edit($id) {
        //
        $team = Team::with('teamPlayer', 'teamPlayer.player')->find($id)->toArray();
        #pd($team);
        $players = Player::getAllPlayers();
        $coaches = Coach::getAllCoaches();
        return view('teams.edit', compact('players', 'coaches', 'team'));
    }

    public function update(Request $request) {
        $input = $request->except('_token');

        if ($request->hasFile('image')) {
            $basePath = 'images/teams/';
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $input['image'] = $basePath . $fileName;
            $img = Image::make($image->getRealPath());
            Storage::disk('local')->put('public/' . $basePath . '/' . $fileName, $img->stream(), 'public');
        }

        $result = Team::updateTeam($input, $input['id']);
        $result = TeamPlayer::addTeamPlayer($input, $input['id']);
        if ($result) {
            return redirect('/teams')->with('success', 'Team updated successfully!');
        } else {
            return back()->withInput();
        }
    }

    public function destroy($id) {
        //
    }

    public function removeTeamMember(Request $request) {
        if (isset($request->select_ids) && count($request->select_ids)) {
            TeamPlayer::removeMembers($request->select_ids);
            return redirect()->back()->with('success', 'Team members deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Please select atleast one member!');
        }
    }

}
