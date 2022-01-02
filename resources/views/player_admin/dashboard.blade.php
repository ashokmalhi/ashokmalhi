@extends('layouts.player.master')

@section('content')
<div class="container-box mt-4">
    <div class="userarea ">
        <div class="colleft">
            @if(!empty($player ?? $player->image_path))
                <img src="{{URL::to('storage/'.$player ?? $player->image_path)}}" alt="" width="50">
            @else
                <img src="images/user.png" alt="">
            @endif
        </div>
        <div class="colright">{{$player ?? $player->image_path}}
            @if(!empty($player ?? $player->image_path))
                <small>{{$player ?? $player->image_path}} Years Old</small>
            @endif
        </div>
    </div>
{{--    {{ dd($topStats) }}--}}

</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col"> </div>

            <player-all-stats-component props-classes="{{ $matchDetails }}" ></player-all-stats-component>

    </div>
</div>

@stop

