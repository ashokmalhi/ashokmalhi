@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<form action="{{url('teams/update')}}" method="POST" id="addTeam" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="id" value="{{$team['id']}}">
    <h3 class="brand-color iconic-text bolder">Edit team</h3>
    <h6>Enter the information of the team below.</h6>

    <div class="col-md-8 mt-5">
        <div class="uploadimg mb-5">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="imgplaceholder  justify-content-center d-flex align-items-center">
                        @if(!empty($team->image))
                        <img src="{{URL::to('storage/'.$team['image'])}}" alt="">
                        @else
                        <img src="{{URL::to('images/user.svg')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center "><input type="file" name="image" class="custom-file-input btn btn-primary"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$team['name']}}" class="form-control" placeholder="Enter team name here">
                </div>
            </div>
            <div class="col">
                <div class="inputfield mb-3">
                    <label>Sport</label>
                    <select name="sport_id" class="form-select">
                        <option value="1">Football</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container-box mt-4">
            <div class="row">
                <div class="col"><b>Team Members</b></div>
                <div class="col"></div>
            </div>
            <div class="box-charts mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($team['team_player']) > 0)
                        @foreach ($team['team_player'] as $player)
                        <tr>
                            <td>{{$player['player']['first_name'].' '.$player['player']['last_name']}}</td>
                            <td>{{$player['player']['email']}}</td>
                            <td>
                                @if($player['is_coach'])
                                Coach
                                @elseif($player['is_manager'])
                                Team Manager
                                @else
                                Player
                                @endif
                            </td>
                            <td><a href="javascript:void(0)" class="btn btn-primary btn-sm">Edit</a> &nbsp; 
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm">Delete</a></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="inputfield mb-3">
                    <a href="javascript:void(0)" class="btn btn-primary mediumbtn" style="margin-top: 25px;" onclick="addPlayer()" >Add Player</a>
                </div>
            </div>
            <div class="col">
                <div class="inputfield mb-3">
                    <a href="javascript:void(0)" class="btn btn-primary mediumbtn" style="margin-top: 25px;" onclick="addCoach()" >Add Coach</a>
                </div>
            </div>
        </div>
        <div id="players">
            <div class="row player new_player" style="display: none;">
                <div class="col">
                    <div class="inputfield mb-3">
                        <label>Enter Player Name</label>
                        <input type="text" name="players_name[]" class="form-control player_names" placeholder="Search Player Name">
                        <input type='hidden' name="player_ids[]" class='player_ids' value='' />
                    </div>
                </div>
                <div class="col">
                    <div class="inputfield mb-3">
                        <label>Select Role</label>
                        <select name="role[]" class="form-select">
                            <option value="1">Player</option>
                            <option value="2">Team Manager</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <a href="javascript:void(0)" class="btn btn-primary mediumbtn" style="margin-top: 25px;" onclick="removePlayer(this)" >Remove</a>
                </div>
            </div>
        </div>

        <div id="coaches">
            <div class="row player new_coach" style="display: none;">
                <div class="col">
                    <div class="inputfield mb-3">
                        <label>Enter Coach Name</label>
                        <input type="text" name="coaches_name[]" class="form-control coach_names" placeholder="Search Coach Name">
                        <input type='hidden' name="coach_ids[]" class='coach_ids' value='' />
                    </div>
                </div>
                <div class="col">
                    <a href="javascript:void(0)" class="btn btn-primary mediumbtn" style="margin-top: 25px;" onclick="removeCoach(this)" >Remove</a>
                </div>
            </div>
        </div>

        <br>
        <div class="inputfield mb-3">
            <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Update Team">
        </div>
    </div>
</form>

@stop
@section('scripts')
<link href="{{URL::to('css/jquery-ui.css')}}" rel="stylesheet">
<script src="{{URL::to('js/jquery-ui.js')}}"></script>
<script>

    var allPlayers = '{!! json_encode($players) !!}';
    allPlayers = JSON.parse(allPlayers);

    var allCoaches = '{!! json_encode($coaches) !!}';
    allCoaches = JSON.parse(allCoaches);

    $(document).ready(function () {
        applyAutocomplete();
    });

    function applyAutocomplete() {

        $(".player_names").autocomplete({
            source: allPlayers,
            focus: function (event, ui) {
                $(this).val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                $(this).val(ui.item.label);
                $(this).closest(".col").find(".player_ids").val(ui.item.value);
                return false;
            }
        });

        $(".coach_names").autocomplete({
            source: allCoaches,
            focus: function (event, ui) {
                $(this).val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                $(this).val(ui.item.label);
                $(this).closest(".col").find(".coach_ids").val(ui.item.value);
                return false;
            }
        });

    }
    function addPlayer() {

        newPlayer = $(".new_player").clone();
        newPlayer = newPlayer.removeClass("new_player");
        newPlayer = newPlayer.css("display", "");
        $("#players").prepend(newPlayer);
        applyAutocomplete();
    }

    function addCoach() {

        newCoach = $(".new_coach").clone();
        newCoach = newCoach.removeClass("new_coach");
        newCoach = newCoach.css("display", "");
        $("#coaches").prepend(newCoach);
        applyAutocomplete();
    }

    function removePlayer(ele) {

        $(ele).closest(".player").remove();
    }

    function removeCoach(ele) {

        $(ele).closest(".coach").remove();
    }

</script>
@endsection
