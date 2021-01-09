@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <h3 class="brand-color iconic-text"><b>All Players</b></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
    <a href="/players/create" class="btn btn-primary" style='float: right;'>Add Player</a>
<div class="container-box mt-4">
    <div class="box-charts mt-3">
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Player</th>
                    <th scope="col">Height</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Max HR (bpm)</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data['players']) > 0)
                    @foreach ($data['players'] as $player)
                    <tr>
                        <td>{{$player['athlete_profile']['first_name'].' '.$player['athlete_profile']['last_name']}}</td>
                        <td>{{$player['athlete_profile']['weight']}}</td>
                        <td>{{$player['athlete_profile']['height']}}</td>
                        <td>{{$player['athlete_profile']['max_heart_rate']}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop

