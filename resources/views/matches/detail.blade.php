@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <p>{{formateDate($matchDetails->match_date,'d M Y H:i a')}}</p>
            <h3 class="brand-color iconic-text"><img src="images/icon-stadium.svg" class="" alt=""><b>{{$matchDetails->name}}</b></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#gamePeriods" type="button" role="tab" aria-controls="home" aria-selected="true">Game Periods</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#teamStats" type="button" role="tab" aria-controls="profile" aria-selected="false">Team Statistics</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#individualPlayers" type="button" role="tab" aria-controls="contact" aria-selected="false">Individual Players</button>
    </li>
</ul>

<div class="container-box mt-4">

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="gamePeriods" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="brand-color iconic-text">Period 1</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sensor</th>
                                <th scope="col">Player no</th>
                                <th scope="col">Player</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Practice Match 1</td>
                                <td>Practice</td>
                                <td>Oct 31, 2018 18:57</td>
                                <td>Europe/Zurich</td>
                                <td>Europe/Zurich</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4 class="brand-color iconic-text">Period 2</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sensor</th>
                                <th scope="col">Player no</th>
                                <th scope="col">Player</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Practice Match 3</td>
                                <td>Practice</td>
                                <td>Oct 31, 2018 18:57</td>
                                <td>Europe/Zurich</td>
                                <td>Europe/Zurich</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="teamStats" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
            <ul class="nav nav-tabs" id="statsTap" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#overall" type="button" role="tab" aria-controls="home" aria-selected="true">Overall</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#period1" type="button" role="tab" aria-controls="profile" aria-selected="false">Period 1</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#period2" type="button" role="tab" aria-controls="contact" aria-selected="false">Period 2</button>
    </li>
</ul>

<div class="container-box mt-4">

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="overall" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="brand-color iconic-text">Team Stats</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sensor</th>
                                        <th scope="col">Player no</th>
                                        <th scope="col">Player Position</th>
                                        <th scope="col">Time Played</th>
                                        <th scope="col">Distance</th>
                                        <th scope="col">HID Distance 15 km</th>
                                        <th scope="col">Distance Speed Range (0-15 km/h)</th>
                                        <th scope="col">Distance Speed Range (15-20 km/h)</th>
                                        <th scope="col">Distance Speed Range (20-25 km/h)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($overAllMatchPlayerDetails)>0)
                                        @foreach($overAllMatchPlayerDetails as $detail)
                                    
                                        <tr>
                                            <td>{{$detail['sensor']}}</td>
                                            <td>{{$detail['players']['player_no']}}</td>
                                            <td>{{$detail['players']['position']}}</td>
                                            <td>{{$detail['time_played']}}</td>
                                            <td>{{$detail['distance_km']}}</td>
                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>No record Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="period1" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                    <div class="col-md-12">
                        <h4 class="brand-color iconic-text">Team Stats</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sensor</th>
                                    <th scope="col">Player no</th>
                                    <th scope="col">Player Position</th>
                                    <th scope="col">Time Played</th>
                                    <th scope="col">Distance</th>
                                    <th scope="col">HID Distance 15 km</th>
                                    <th scope="col">Distance Speed Range (0-15 km/h)</th>
                                    <th scope="col">Distance Speed Range (15-20 km/h)</th>
                                    <th scope="col">Distance Speed Range (20-25 km/h)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($period1Detail)>0)
                                    @foreach($period1Detail as $detail)
                                        <tr>
                                            <td>{{$detail['sensor']}}</td>
                                            <td>{{$detail['players']['player_no']}}</td>
                                            <td>{{$detail['players']['position']}}</td>
                                            <td>{{$detail['time_played']}}</td>
                                            <td>{{$detail['distance_km']}}</td>
                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>No record Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        <div class="tab-pane fade" id="period2" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                    <div class="col-md-12">
                        <h4 class="brand-color iconic-text">Team Stats</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sensor</th>
                                    <th scope="col">Player no</th>
                                    <th scope="col">Player Position</th>
                                    <th scope="col">Time Played</th>
                                    <th scope="col">Distance</th>
                                    <th scope="col">HID Distance 15 km</th>
                                    <th scope="col">Distance Speed Range (0-15 km/h)</th>
                                    <th scope="col">Distance Speed Range (15-20 km/h)</th>
                                    <th scope="col">Distance Speed Range (20-25 km/h)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($period2Detail)>0)
                                    @foreach($period2Detail as $detail)
                                        <tr>
                                            <td>{{$detail['sensor']}}</td>
                                            <td>{{$detail['players']['player_no']}}</td>
                                            <td>{{$detail['players']['position']}}</td>
                                            <td>{{$detail['time_played']}}</td>
                                            <td>{{$detail['distance_km']}}</td>
                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>No record Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>

</div>
                </div>
            </div>
        <div class="tab-pane fade" id="individualPlayers" role="tabpanel" aria-labelledby="contact-tab">

        </div>
    </div>

</div>
@stop

