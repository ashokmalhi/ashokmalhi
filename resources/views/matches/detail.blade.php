@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <p>{{formateDate($matchDetails->match_date,'d M Y H:i a')}}</p>
            <h3 class="brand-color iconic-text"><img src="{{asset('images/icon-stadium.svg')}}" class="" alt=""><b>{{$matchDetails->name}}</b></h3>
            <input type="hidden" id="matchId" value="{{$matchDetails->id}}">
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<ul class="nav nav-tabs" id="teamsTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="team-1-tab" data-bs-toggle="tab" data-bs-target="#team1Stats" type="button" role="tab" aria-controls="profile" aria-selected="false">Team 1</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="team-2-tab" data-bs-toggle="tab" data-bs-target="#team2Stats" type="button" role="tab" aria-controls="contact" aria-selected="false">Team 2</button>
    </li>
</ul>

<div class="container-box mt-4">

    <div class="tab-content" id="teamsTabContent">

        <div class="tab-pane fade show active" id="team1Stats" role="tabpanel" aria-labelledby="team-1-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="team-1-state-tab" data-bs-toggle="tab" data-bs-target="#teamStats" type="button" role="tab" aria-controls="profile" aria-selected="false">Team Statistics</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="individual-team1-state-tab" data-bs-toggle="tab" data-bs-target="#individualPlayers" type="button" role="tab" aria-controls="contact" aria-selected="false">Individual Players</button>
                </li>
            </ul>

            <div class="container-box mt-4">

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="teamStats" role="tabpanel" aria-labelledby="team-1-state-tab">
                        <div class="row">
                            <ul class="nav nav-tabs" id="statsTap" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="team1-overall-tab" data-bs-toggle="tab" data-bs-target="#team1overall" type="button" role="tab" aria-controls="home" aria-selected="true">Overall</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="team1-period1-tab" data-bs-toggle="tab" data-bs-target="#team1period1" type="button" role="tab" aria-controls="profile" aria-selected="false">Period 1</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="team1-period2-tab" data-bs-toggle="tab" data-bs-target="#team1period2" type="button" role="tab" aria-controls="contact" aria-selected="false">Period 2</button>
                                </li>
                            </ul>

                            <div class="container-box mt-4">

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="team1overall" role="tabpanel" aria-labelledby="team1-period1-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="brand-color iconic-text">Team Stats</h4>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sensor</th>
                                                            <th scope="col">Player no</th>
                                                            <th scope="col">Player Name</th>
                                                            <th scope="col">Player Position</th>
                                                            <th scope="col">Time Played</th>
                                                            <th scope="col">Distance</th>
                                                            <th scope="col">HID Distance 15 km</th>
                                                            <th scope="col">Distance Speed Range (0-15 km/h)</th>
                                                            <th scope="col">Distance Speed Range (15-20 km/h)</th>
                                                            <th scope="col">Distance Speed Range (20-25 km/h)</th>

                                                            <th scope="col">Distance Speed Range (25-30 km/h)</th>
                                                            <th scope="col">Distance Speed Range (>30 km/h)</th>
                                                            <th scope="col"># of Sprints (>25 km/h)</th>
                                                            <th scope="col">Avg. Speed (km/h)</th>
                                                            <th scope="col">Max Speed (km/h)</th>
                                                            <th scope="col">Max Acceleration (m/s²)</th>
                                                            <th scope="col"># of Accelerations (>3 m/s²)</th>
                                                            <th scope="col"># of Accelerations (>4 m/s²)</th>
                                                            <th scope="col"># of Decelerations (>3 m/s²)</th>
                                                            <th scope="col"># of Decelerations (>4 m/s²)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($overAllMatchPlayerDetailsTeam1)>0)
                                                        @foreach($overAllMatchPlayerDetailsTeam1 as $detail)

                                                        <tr>
                                                            <td>{{$detail['sensor']}}</td>
                                                            <td>{{$detail['players']['player_no']}}</td>
                                                            <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                                            <td>{{$detail['players']['position']}}</td>
                                                            <td>{{$detail['time_played']}}</td>
                                                            <td>{{$detail['distance_km']}}</td>
                                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                                            <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                            <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                            <td>{{$detail['avg_speed_km']}}</td>
                                                            <td>{{$detail['max_speed_km']}}</td>
                                                            <td>{{$detail['max_acceleration']}}</td>
                                                            <td>{{$detail['no_of_acceleration_3']}}</td>
                                                            <td>{{$detail['no_of_acceleration_4']}}</td>
                                                            <td>{{$detail['no_of_deceleration_3']}}</td>
                                                            <td>{{$detail['no_of_deceleration_4']}}</td>
                                                        </tr>
                                                        @endforeach
                                                        @foreach($overallSummary['team_1'] as $detail)
                                                        <tr>
                                                            <td>{{!empty($detail['sensor'])??''}}</td>
                                                            <td>{{$detail['players']['player_no']??''}}</td>
                                                            <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                                            <td>{{$detail['players']['position']??''}}</td>
                                                            <td>{{$detail['time_played']??''}}</td>
                                                            <td>{{$detail['distance_km']}}</td>
                                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                                            <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                            <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                            <td>{{$detail['avg_speed_km']}}</td>
                                                            <td>{{$detail['max_speed_km']}}</td>
                                                            <td>{{$detail['max_acceleration']}}</td>
                                                            <td>{{$detail['no_of_acceleration_3']}}</td>
                                                            <td>{{$detail['no_of_acceleration_4']}}</td>
                                                            <td>{{$detail['no_of_deceleration_3']}}</td>
                                                            <td>{{$detail['no_of_deceleration_4']}}</td>
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
                                    <div class="tab-pane fade" id="team1period1" role="tabpanel" aria-labelledby="team1-period2-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="brand-color iconic-text">Team Stats</h4>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sensor</th>
                                                            <th scope="col">Player no</th>
                                                            <th scope="col">Player Name</th>
                                                            <th scope="col">Player Position</th>
                                                            <th scope="col">Time Played</th>
                                                            <th scope="col">Distance</th>
                                                            <th scope="col">HID Distance 15 km</th>
                                                            <th scope="col">Distance Speed Range (0-15 km/h)</th>
                                                            <th scope="col">Distance Speed Range (15-20 km/h)</th>
                                                            <th scope="col">Distance Speed Range (20-25 km/h)</th>

                                                            <th scope="col">Distance Speed Range (25-30 km/h)</th>
                                                            <th scope="col">Distance Speed Range (>30 km/h)</th>
                                                            <th scope="col"># of Sprints (>25 km/h)</th>
                                                            <th scope="col">Avg. Speed (km/h)</th>
                                                            <th scope="col">Max Speed (km/h)</th>
                                                            <th scope="col">Max Acceleration (m/s²)</th>
                                                            <th scope="col"># of Accelerations (>3 m/s²)</th>
                                                            <th scope="col"># of Accelerations (>4 m/s²)</th>
                                                            <th scope="col"># of Decelerations (>3 m/s²)</th>
                                                            <th scope="col"># of Decelerations (>4 m/s²)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($periodDetail['team_1']['period1'])>0)
                                                        @foreach($periodDetail['team_1']['period1'] as $detail)
                                                        <tr>
                                                            <td>{{$detail['sensor']}}</td>
                                                            <td>{{$detail['players']['player_no']}}</td>
                                                            <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                                            <td>{{$detail['players']['position']}}</td>
                                                            <td>{{$detail['time_played']}}</td>
                                                            <td>{{$detail['distance_km']}}</td>
                                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                                            <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                            <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                            <td>{{$detail['avg_speed_km']}}</td>
                                                            <td>{{$detail['max_speed_km']}}</td>
                                                            <td>{{$detail['max_acceleration']}}</td>
                                                            <td>{{$detail['no_of_acceleration_3']}}</td>
                                                            <td>{{$detail['no_of_acceleration_4']}}</td>
                                                            <td>{{$detail['no_of_deceleration_3']}}</td>
                                                            <td>{{$detail['no_of_deceleration_4']}}</td>
                                                        </tr>
                                                        @endforeach
                                                        @foreach($periodSummary['team_1']['period1'] as $detail)
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>{{$detail['distance_km']}}</td>
                                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                                            <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                            <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                            <td>{{$detail['avg_speed_km']}}</td>
                                                            <td>{{$detail['max_speed_km']}}</td>
                                                            <td>{{$detail['max_acceleration']}}</td>
                                                            <td>{{$detail['no_of_acceleration_3']}}</td>
                                                            <td>{{$detail['no_of_acceleration_4']}}</td>
                                                            <td>{{$detail['no_of_deceleration_3']}}</td>
                                                            <td>{{$detail['no_of_deceleration_4']}}</td>
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
                                    <div class="tab-pane fade" id="team1period2" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="brand-color iconic-text">Team Stats</h4>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sensor</th>
                                                            <th scope="col">Player no</th>
                                                            <th scope="col">Player Name</th>
                                                            <th scope="col">Player Position</th>
                                                            <th scope="col">Time Played</th>
                                                            <th scope="col">Distance</th>
                                                            <th scope="col">HID Distance 15 km</th>
                                                            <th scope="col">Distance Speed Range (0-15 km/h)</th>
                                                            <th scope="col">Distance Speed Range (15-20 km/h)</th>
                                                            <th scope="col">Distance Speed Range (20-25 km/h)</th>

                                                            <th scope="col">Distance Speed Range (25-30 km/h)</th>
                                                            <th scope="col">Distance Speed Range (>30 km/h)</th>
                                                            <th scope="col"># of Sprints (>25 km/h)</th>
                                                            <th scope="col">Avg. Speed (km/h)</th>
                                                            <th scope="col">Max Speed (km/h)</th>
                                                            <th scope="col">Max Acceleration (m/s²)</th>
                                                            <th scope="col"># of Accelerations (>3 m/s²)</th>
                                                            <th scope="col"># of Accelerations (>4 m/s²)</th>
                                                            <th scope="col"># of Decelerations (>3 m/s²)</th>
                                                            <th scope="col"># of Decelerations (>4 m/s²)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($periodDetail['team_1']['period2'])>0)
                                                        @foreach($periodDetail['team_1']['period2'] as $detail)
                                                        <tr>
                                                            <td>{{$detail['sensor']}}</td>
                                                            <td>{{$detail['players']['player_no']}}</td>
                                                            <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                                            <td>{{$detail['players']['position']}}</td>
                                                            <td>{{$detail['time_played']}}</td>
                                                            <td>{{$detail['distance_km']}}</td>
                                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                            <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                            <td>{{$detail['avg_speed_km']}}</td>
                                                            <td>{{$detail['max_speed_km']}}</td>
                                                            <td>{{$detail['max_acceleration']}}</td>
                                                            <td>{{$detail['no_of_acceleration_3']}}</td>
                                                            <td>{{$detail['no_of_acceleration_4']}}</td>
                                                            <td>{{$detail['no_of_deceleration_3']}}</td>
                                                            <td>{{$detail['no_of_deceleration_4']}}</td>

                                                        </tr>
                                                        @endforeach
                                                        @foreach($periodSummary['team_1']['period2'] as $detail)
                                                        <tr>
                                                            <td>{{!empty($detail['sensor'])??''}}</td>
                                                            <td>{{$detail['players']['player_no']??''}}</td>
                                                            <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                                            <td>{{$detail['players']['position']??''}}</td>
                                                            <td>{{$detail['time_played']??''}}</td>
                                                            <td>{{$detail['distance_km']}}</td>
                                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                            <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                            <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                            <td>{{$detail['avg_speed_km']}}</td>
                                                            <td>{{$detail['max_speed_km']}}</td>
                                                            <td>{{$detail['max_acceleration']}}</td>
                                                            <td>{{$detail['no_of_acceleration_3']}}</td>
                                                            <td>{{$detail['no_of_acceleration_4']}}</td>
                                                            <td>{{$detail['no_of_deceleration_3']}}</td>
                                                            <td>{{$detail['no_of_deceleration_4']}}</td>
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
                    <div class="tab-pane fade" id="individualPlayers" role="tabpanel" aria-labelledby="individual-team1-state-tab">

                        @if(count($data['individualPlayers']['team_1']) > 0)
                        <ul class="list-group">

                            @foreach($data['individualPlayers']['team_1'] as $player)

                            <a href="javascript:void(0)"><li id="player-{{$player->player_id}}" class="individualPlayerDetails" data-id="{{$player->player_id}}">{{$player->first_name.' '.$player->last_name}}</li></a>

                            @endforeach

                        </ul>
                        @endif

                        <div id="player-details-team1">
                            <?php
                            $firstPlayer = isset($data['individualPlayers']['team_1'][0]) ? $data['individualPlayers']['team_1'][0] : "";
                            if (isset($firstPlayer->matchStats) && count($firstPlayer->matchStats) > 0) {

                                $totalTimePlayed = '00:00:00';
                                $totalDistance = $noOfAcceleration1 = $noOfAcceleration2 = 0;
                                $noOfDeceleration1 = $noOfDeceleration2 = $noOfSprints = $hidDistance = 0;
                                $avgSpeed = $maxSpeed = $maxAcceleration = 0;
                                $distanceSpeedRange15 = $distanceSpeedRange15_20 = $distanceSpeedRange20_25 = $distanceSpeedRange25_30 = $distanceSpeedRangeGreater_30 = 0;

                                foreach ($firstPlayer->matchStats as $stat) {

                                    $secs = strtotime($totalTimePlayed) - strtotime("00:00:00");
                                    $totalTimePlayed = date("H:i:s", strtotime($stat->time_played) + $secs);

                                    $totalDistance += $stat->distance_km;
                                    $noOfAcceleration1 += $stat->no_of_acceleration_3;
                                    $noOfAcceleration2 += $stat->no_of_acceleration_4;
                                    $noOfDeceleration1 += $stat->no_of_deceleration_3;
                                    $noOfDeceleration2 += $stat->no_of_deceleration_4;
                                    $noOfSprints += $stat->no_of_sprint_greater_25_km;
                                    $hidDistance += $stat->hid_distance_15_km;
                                    $avgSpeed += $stat->avg_speed_km;
                                    $maxSpeed += $stat->max_speed_km;
                                    $maxAcceleration += $stat->max_acceleration;
                                    
                                    $distanceSpeedRange15 += $stat->distance_speed_range_15_km;
                                    $distanceSpeedRange15_20 += $stat->distance_speed_range_15_20_km;
                                    $distanceSpeedRange20_25 += $stat->distance_speed_range_20_25_km;
                                    $distanceSpeedRange25_30 += $stat->distance_speed_range_25_30_km;
                                    $distanceSpeedRangeGreater_30 += $stat->distance_speed_range_greater_30_km;
                                }
                            }
                            ?>
                            @if($firstPlayer)
                            <div class="container-box mt-4">
                                <div class="userarea ">
                                    <div class="colright">{{$firstPlayer->first_name.' '.$firstPlayer->last_name}} 
                                    </div>
                                </div>
                                <div class="counts mt-4">
                                    <div class="values col"> <img src="{{asset('images/icon-distance.svg')}}" alt="">
                                            <p>Time Played</p>
                                            <h4 class="brand-color">{{$totalTimePlayed}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-distance.svg')}}" alt="">
                                            <p>Total Distance (km)</p>
                                            <h4 class="brand-color">{{$totalDistance}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-running.svg')}}" alt="">
                                            <p># of Accelerations(>0.5 m/s²)</p>
                                            <h4 class="brand-color">{{$noOfAcceleration1}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-speedometer.svg')}}" alt="">
                                            <p># of Accelerations(>3 m/s²)</p>
                                            <h4 class="brand-color">{{$noOfAcceleration2}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-running.svg')}}" alt="">
                                            <p># of Decelerations(>0.5 m/s²)</p>
                                            <h4 class="brand-color">{{$noOfDeceleration1}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-distance.svg')}}" alt="">
                                            <p># of Decelerations(>3 m/s²)</p>
                                            <h4 class="brand-color">{{$noOfDeceleration2}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-clock.svg')}}" alt="">
                                            <p># of Sprints(>19.8 km/h)</p>
                                            <h4 class="brand-color">{{$noOfSprints}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-reverse.svg')}}" alt="">
                                            <p>HID Distance(>19.8 km/h)</p>
                                            <h4 class="brand-color">{{$hidDistance}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-load.svg')}}" alt="">
                                            <p>Avg. Speed(km/h)</p>
                                            <h4 class="brand-color">{{$avgSpeed}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-load.svg')}}" alt="">
                                            <p>Max Speed(km/h)</p>
                                            <h4 class="brand-color">{{$maxSpeed}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-load.svg')}}" alt="">
                                            <p>Max Acceleration(m/s²)</p>
                                            <h4 class="brand-color">{{$maxAcceleration}}</h4>
                                        </div>
                                </div>
                            </div>
                            <div class="container-box mt-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col"><b>Distances Per Speed Range</b></div>
                                        </div>
                                        <div class="box-charts mt-3">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">All Speeds</th>
                                                        <th scope="col">{{$totalDistance}} km</th>
                                                        <th scope="col">100%</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>0-15 km/h</td>
                                                        <td>{{$distanceSpeedRange15}}</td>
                                                        <td>{{calculatePercentage($totalDistance,$distanceSpeedRange15)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>15-20 km/h</td>
                                                        <td>{{$distanceSpeedRange15_20}}</td>
                                                        <td>{{calculatePercentage($totalDistance,$distanceSpeedRange15_20)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>20-25 km/h</td>
                                                        <td>{{$distanceSpeedRange20_25}}</td>
                                                        <td>{{calculatePercentage($totalDistance,$distanceSpeedRange20_25)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>25-30 km/h</td>
                                                        <td>{{$distanceSpeedRange25_30}}</td>
                                                        <td>{{calculatePercentage($totalDistance,$distanceSpeedRange25_30)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>>30 km/h</td>
                                                        <td>{{$distanceSpeedRangeGreater_30}}</td>
                                                        <td>{{calculatePercentage($totalDistance,$distanceSpeedRangeGreater_30)}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col"><b>Recently Generated Statistics</b></div>
                                        </div>
                                        <div class="box-charts mt-3">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Statistics Date</th>
                                                        <th scope="col">Timezone</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Practice Match 1</td>
                                                        <td>Practice</td>
                                                        <td>Oct 31, 2018 18:57</td>
                                                        <td>Europe/Zurich</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Practice Match 2</td>
                                                        <td>Practice</td>
                                                        <td>Oct 31, 2018 18:57</td>
                                                        <td>Europe/Zurich</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Practice Match 3</td>
                                                        <td>Practice</td>
                                                        <td>Oct 31, 2018 18:57</td>
                                                        <td>Europe/Zurich</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="team2Stats" role="tabpanel" aria-labelledby="team-2-tab">

                <ul class="nav nav-tabs" id="myTab1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="team-2-state-tab" data-bs-toggle="tab" data-bs-target="#team2PlayerStats" type="button" role="tab" aria-controls="profile" aria-selected="false">Team Statistics</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="individual-team2-state-tab" data-bs-toggle="tab" data-bs-target="#individual2Players" type="button" role="tab" aria-controls="contact" aria-selected="false">Individual Players</button>
                    </li>
                </ul>

                <div class="container-box mt-4">

                    <div class="tab-content" id="myTab1Content">

                        <div class="tab-pane fade show active" id="team2PlayerStats" role="tabpanel" aria-labelledby="team-2-state-tab">
                            <div class="row">
                                <ul class="nav nav-tabs" id="statsTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="team2-overall-tab" data-bs-toggle="tab" data-bs-target="#team2overall" type="button" role="tab" aria-controls="home" aria-selected="true">Overall</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="team2-period1-tab" data-bs-toggle="tab" data-bs-target="#team2period1" type="button" role="tab" aria-controls="profile" aria-selected="false">Period 1</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="team2-period2-tab" data-bs-toggle="tab" data-bs-target="#team2period2" type="button" role="tab" aria-controls="contact" aria-selected="false">Period 2</button>
                                    </li>
                                </ul>

                                <div class="container-box mt-4">

                                    <div class="tab-content" id="statsTabContent">
                                        <div class="tab-pane fade show active" id="team2overall" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 class="brand-color iconic-text">Team Stats</h4>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Sensor</th>
                                                                <th scope="col">Player no</th>
                                                                <th scope="col">Player Name</th>
                                                                <th scope="col">Player Position</th>
                                                                <th scope="col">Time Played</th>
                                                                <th scope="col">Distance</th>
                                                                <th scope="col">HID Distance 15 km</th>
                                                                <th scope="col">Distance Speed Range (0-15 km/h)</th>
                                                                <th scope="col">Distance Speed Range (15-20 km/h)</th>
                                                                <th scope="col">Distance Speed Range (20-25 km/h)</th>

                                                                <th scope="col">Distance Speed Range (25-30 km/h)</th>
                                                                <th scope="col">Distance Speed Range (>30 km/h)</th>
                                                                <th scope="col"># of Sprints (>25 km/h)</th>
                                                                <th scope="col">Avg. Speed (km/h)</th>
                                                                <th scope="col">Max Speed (km/h)</th>
                                                                <th scope="col">Max Acceleration (m/s²)</th>
                                                                <th scope="col"># of Accelerations (>3 m/s²)</th>
                                                                <th scope="col"># of Accelerations (>4 m/s²)</th>
                                                                <th scope="col"># of Decelerations (>3 m/s²)</th>
                                                                <th scope="col"># of Decelerations (>4 m/s²)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(count($overAllMatchPlayerDetailsTeam2)>0)
                                                            @foreach($overAllMatchPlayerDetailsTeam2 as $detail)

                                                            <tr>
                                                                <td>{{$detail['sensor']}}</td>
                                                                <td>{{$detail['players']['player_no']}}</td>
                                                                <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                                                <td>{{$detail['players']['position']}}</td>
                                                                <td>{{$detail['time_played']}}</td>
                                                                <td>{{$detail['distance_km']}}</td>
                                                                <td>{{$detail['hid_distance_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                                                <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                                <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                                <td>{{$detail['avg_speed_km']}}</td>
                                                                <td>{{$detail['max_speed_km']}}</td>
                                                                <td>{{$detail['max_acceleration']}}</td>
                                                                <td>{{$detail['no_of_acceleration_3']}}</td>
                                                                <td>{{$detail['no_of_acceleration_4']}}</td>
                                                                <td>{{$detail['no_of_deceleration_3']}}</td>
                                                                <td>{{$detail['no_of_deceleration_4']}}</td>
                                                            </tr>
                                                            @endforeach
                                                            @foreach($overallSummary['team_2'] as $detail)
                                                            <tr>
                                                                <td>{{!empty($detail['sensor'])??''}}</td>
                                                                <td>{{$detail['players']['player_no']??''}}</td>
                                                                <td>{{$detail['players']['position']??''}}</td>
                                                                <td>{{$detail['time_played']??''}}</td>
                                                                <td>{{$detail['distance_km']}}</td>
                                                                <td>{{$detail['hid_distance_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                                                <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                                <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                                <td>{{$detail['avg_speed_km']}}</td>
                                                                <td>{{$detail['max_speed_km']}}</td>
                                                                <td>{{$detail['max_acceleration']}}</td>
                                                                <td>{{$detail['no_of_acceleration_3']}}</td>
                                                                <td>{{$detail['no_of_acceleration_4']}}</td>
                                                                <td>{{$detail['no_of_deceleration_3']}}</td>
                                                                <td>{{$detail['no_of_deceleration_4']}}</td>
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
                                        <div class="tab-pane fade" id="team2period1" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 class="brand-color iconic-text">Team Stats</h4>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Sensor</th>
                                                                <th scope="col">Player no</th>
                                                                <th scope="col">Player Name</th>
                                                                <th scope="col">Player Position</th>
                                                                <th scope="col">Time Played</th>
                                                                <th scope="col">Distance</th>
                                                                <th scope="col">HID Distance 15 km</th>
                                                                <th scope="col">Distance Speed Range (0-15 km/h)</th>
                                                                <th scope="col">Distance Speed Range (15-20 km/h)</th>
                                                                <th scope="col">Distance Speed Range (20-25 km/h)</th>

                                                                <th scope="col">Distance Speed Range (25-30 km/h)</th>
                                                                <th scope="col">Distance Speed Range (>30 km/h)</th>
                                                                <th scope="col"># of Sprints (>25 km/h)</th>
                                                                <th scope="col">Avg. Speed (km/h)</th>
                                                                <th scope="col">Max Speed (km/h)</th>
                                                                <th scope="col">Max Acceleration (m/s²)</th>
                                                                <th scope="col"># of Accelerations (>3 m/s²)</th>
                                                                <th scope="col"># of Accelerations (>4 m/s²)</th>
                                                                <th scope="col"># of Decelerations (>3 m/s²)</th>
                                                                <th scope="col"># of Decelerations (>4 m/s²)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(count($periodDetail['team_2']['period1'])>0)
                                                            @foreach($periodDetail['team_2']['period1'] as $detail)
                                                            <tr>
                                                                <td>{{$detail['sensor']}}</td>
                                                                <td>{{$detail['players']['player_no']}}</td>
                                                                <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                                                <td>{{$detail['players']['position']}}</td>
                                                                <td>{{$detail['time_played']}}</td>
                                                                <td>{{$detail['distance_km']}}</td>
                                                                <td>{{$detail['hid_distance_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                                                <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                                <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                                <td>{{$detail['avg_speed_km']}}</td>
                                                                <td>{{$detail['max_speed_km']}}</td>
                                                                <td>{{$detail['max_acceleration']}}</td>
                                                                <td>{{$detail['no_of_acceleration_3']}}</td>
                                                                <td>{{$detail['no_of_acceleration_4']}}</td>
                                                                <td>{{$detail['no_of_deceleration_3']}}</td>
                                                                <td>{{$detail['no_of_deceleration_4']}}</td>
                                                            </tr>
                                                            @endforeach
                                                            @foreach($periodSummary['team_2']['period1'] as $detail)
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>{{$detail['distance_km']}}</td>
                                                                <td>{{$detail['hid_distance_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_20_25_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                                <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                                <td>{{$detail['avg_speed_km']}}</td>
                                                                <td>{{$detail['max_speed_km']}}</td>
                                                                <td>{{$detail['max_acceleration']}}</td>
                                                                <td>{{$detail['no_of_acceleration_3']}}</td>
                                                                <td>{{$detail['no_of_acceleration_4']}}</td>
                                                                <td>{{$detail['no_of_deceleration_3']}}</td>
                                                                <td>{{$detail['no_of_deceleration_4']}}</td>
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
                                        <div class="tab-pane fade" id="team2period2" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 class="brand-color iconic-text">Team Stats</h4>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Sensor</th>
                                                                <th scope="col">Player no</th>
                                                                <th scope="col">Player Name</th>
                                                                <th scope="col">Player Position</th>
                                                                <th scope="col">Time Played</th>
                                                                <th scope="col">Distance</th>
                                                                <th scope="col">HID Distance 15 km</th>
                                                                <th scope="col">Distance Speed Range (0-15 km/h)</th>
                                                                <th scope="col">Distance Speed Range (15-20 km/h)</th>
                                                                <th scope="col">Distance Speed Range (20-25 km/h)</th>

                                                                <th scope="col">Distance Speed Range (25-30 km/h)</th>
                                                                <th scope="col">Distance Speed Range (>30 km/h)</th>
                                                                <th scope="col"># of Sprints (>25 km/h)</th>
                                                                <th scope="col">Avg. Speed (km/h)</th>
                                                                <th scope="col">Max Speed (km/h)</th>
                                                                <th scope="col">Max Acceleration (m/s²)</th>
                                                                <th scope="col"># of Accelerations (>3 m/s²)</th>
                                                                <th scope="col"># of Accelerations (>4 m/s²)</th>
                                                                <th scope="col"># of Decelerations (>3 m/s²)</th>
                                                                <th scope="col"># of Decelerations (>4 m/s²)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(count($periodDetail['team_2']['period2'])>0)
                                                            @foreach($periodDetail['team_2']['period2'] as $detail)
                                                            <tr>
                                                                <td>{{$detail['sensor']}}</td>
                                                                <td>{{$detail['players']['player_no']}}</td>
                                                                <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                                                <td>{{$detail['players']['position']}}</td>
                                                                <td>{{$detail['time_played']}}</td>
                                                                <td>{{$detail['distance_km']}}</td>
                                                                <td>{{$detail['hid_distance_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                                                <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                                <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                                <td>{{$detail['avg_speed_km']}}</td>
                                                                <td>{{$detail['max_speed_km']}}</td>
                                                                <td>{{$detail['max_acceleration']}}</td>
                                                                <td>{{$detail['no_of_acceleration_3']}}</td>
                                                                <td>{{$detail['no_of_acceleration_4']}}</td>
                                                                <td>{{$detail['no_of_deceleration_3']}}</td>
                                                                <td>{{$detail['no_of_deceleration_4']}}</td>
                                                            </tr>
                                                            @endforeach
                                                            @foreach($periodSummary['team_2']['period2'] as $detail)
                                                            <tr>
                                                                <td>{{!empty($detail['sensor'])??''}}</td>
                                                                <td>{{$detail['players']['player_no']??''}}</td>
                                                                <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                                                <td>{{$detail['players']['position']??''}}</td>
                                                                <td>{{$detail['time_played']??''}}</td>
                                                                <td>{{$detail['distance_km']}}</td>
                                                                <td>{{$detail['hid_distance_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                                                <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                                                <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                                                <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                                                <td>{{$detail['avg_speed_km']}}</td>
                                                                <td>{{$detail['max_speed_km']}}</td>
                                                                <td>{{$detail['max_acceleration']}}</td>
                                                                <td>{{$detail['no_of_acceleration_3']}}</td>
                                                                <td>{{$detail['no_of_acceleration_4']}}</td>
                                                                <td>{{$detail['no_of_deceleration_3']}}</td>
                                                                <td>{{$detail['no_of_deceleration_4']}}</td>
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
                        <div class="tab-pane fade" id="individual2Players" role="tabpanel" aria-labelledby="individual-team2-state-tab">

                            @if(count($data['individualPlayers']['team_2']) > 0)
                            <ul class="list-group">

                                @foreach($data['individualPlayers']['team_2'] as $player)

                                <a href="javascript:void(0)"><li id="player-{{$player->player_id}}">{{$player->first_name.' '.$player->last_name}}</li></a>

                                @endforeach

                            </ul>
                            @endif

                            <div id="player-details-team2">
                                <?php
                                $firstPlayer = isset($data['individualPlayers']['team_2'][0]) ? $data['individualPlayers']['team_2'][0] : "";
                                if (isset($firstPlayer->matchStats) && count($firstPlayer->matchStats) > 0) {

                                    $totalTimePlayed = '00:00:00';
                                    $totalDistance = $noOfAcceleration1 = $noOfAcceleration2 = 0;
                                    $noOfDeceleration1 = $noOfDeceleration2 = $noOfSprints = $hidDistance = 0;
                                    $avgSpeed = $maxSpeed = $maxAcceleration = 0;

                                    foreach ($firstPlayer->matchStats as $stat) {

                                        $secs = strtotime($totalTimePlayed) - strtotime("00:00:00");
                                        $totalTimePlayed = date("H:i:s", strtotime($stat->time_played) + $secs);

                                        $totalDistance += $stat->distance_km;
                                        $noOfAcceleration1 += $stat->no_of_acceleration_3;
                                        $noOfAcceleration2 += $stat->no_of_acceleration_4;
                                        $noOfDeceleration1 += $stat->no_of_deceleration_3;
                                        $noOfDeceleration2 += $stat->no_of_deceleration_4;
                                        $noOfSprints += $stat->no_of_sprint_greater_25_km;
                                        $hidDistance += $stat->hid_distance_15_km;
                                        $avgSpeed += $stat->avg_speed_km;
                                        $maxSpeed += $stat->max_speed_km;
                                        $maxAcceleration += $stat->max_acceleration;
                                    }
                                }
                                ?>
                                @if($firstPlayer)
                                <div class="container-box mt-4">
                                    <div class="userarea ">
                                        <div class="colright">{{$firstPlayer->first_name.' '.$firstPlayer->last_name}} 
                                        </div>
                                    </div>
                                    <div class="counts mt-4">
                                        <div class="values col"> <img src="{{asset('images/icon-distance.svg')}}" alt="">
                                            <p>Time Played</p>
                                            <h4 class="brand-color">{{$totalTimePlayed}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-distance.svg')}}" alt="">
                                            <p>Total Distance (km)</p>
                                            <h4 class="brand-color">{{$totalDistance}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-running.svg')}}" alt="">
                                            <p># of Accelerations(>0.5 m/s²)</p>
                                            <h4 class="brand-color">{{$noOfAcceleration1}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-speedometer.svg')}}" alt="">
                                            <p># of Accelerations(>3 m/s²)</p>
                                            <h4 class="brand-color">{{$noOfAcceleration2}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-running.svg')}}" alt="">
                                            <p># of Decelerations(>0.5 m/s²)</p>
                                            <h4 class="brand-color">{{$noOfDeceleration1}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-distance.svg')}}" alt="">
                                            <p># of Decelerations(>3 m/s²)</p>
                                            <h4 class="brand-color">{{$noOfDeceleration2}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-clock.svg')}}" alt="">
                                            <p># of Sprints(>19.8 km/h)</p>
                                            <h4 class="brand-color">{{$noOfSprints}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-reverse.svg')}}" alt="">
                                            <p>HID Distance(>19.8 km/h)</p>
                                            <h4 class="brand-color">{{$hidDistance}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-load.svg')}}" alt="">
                                            <p>Avg. Speed(km/h)</p>
                                            <h4 class="brand-color">{{$avgSpeed}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-load.svg')}}" alt="">
                                            <p>Max Speed(km/h)</p>
                                            <h4 class="brand-color">{{$maxSpeed}}</h4>
                                        </div>
                                        <div class="values col"> <img src="{{asset('images/icon-load.svg')}}" alt="">
                                            <p>Max Acceleration(m/s²)</p>
                                            <h4 class="brand-color">{{$maxAcceleration}}</h4>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>    
@section('scripts')
<script>
    
$(document).ready(function () {
    
    
});
</script>
@endsection

@stop

