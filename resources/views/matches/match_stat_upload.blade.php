@extends('layouts.master')

@section('content')


<form action="{{route('team_player_stats')}}" method="post" id="addStat" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name='match_id' value="{{$match->id}}">
    <h3 class="brand-color iconic-text bolder">Upload Match Player Stats</h3>
    <h6>Please upload players stats. Match info given blow</h6>

    <div class="col-md-8 mt-5">
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Match Name</label>
                    <input type="text" value="{{$match->name}}" class="form-control" disabled>
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Match Date</label>
                    <input type="text" value="{{$match->match_date}}" class="form-control" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Team 1 Players (Multiple upload)</label>
                    <input type="file" name="team_1_players[]" class="form-control" multiple="">
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Team 2 Players (Multiple upload)</label>
                    <input type="file" name="team_2_players[]" class="form-control" multiple="">
                </div>
            </div>
        </div>
        
        <div class="inputfield mb-3">
            <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Upload Stats">
        </div>

    </div>
</form>

@stop
