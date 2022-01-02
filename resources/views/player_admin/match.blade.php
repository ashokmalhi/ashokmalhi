@extends('layouts.player.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <p>{{ \Carbon\Carbon::parse($player->match_date)->toDayDateTimeString() }}</p>
            <h3 class="brand-color iconic-text"><img src="images/icon-stadium.svg" class="" alt=""><b>{{$player->mt_name}}</b></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<div class="container-box mt-4">
    <div class="userarea ">
        <div class="colleft">
            @if(!empty($player->image_path))
                <img src="{{URL::to('storage/'.$player->image_path)}}" alt="" width="50">
            @else
                <img src="images/user.png" alt="">
            @endif
        </div>
        <div class="colright">{{$player->name}}
            @if(!empty($player->age))
                <small>{{$player->age}} Years Old</small>
            @endif
        </div>
    </div>
{{--    {{ dd($topStats) }}--}}
    <div class="counts mt-4">
        <div class="values col"> <img src="{{asset('images/icon-distance.svg')}}" alt="">
            <p>Time Played</p>
            <h4 class="brand-color">{{$topStats['totalTimePlayed'] ?? null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-distance.svg')}}" alt="">
            <p>Total Distance (km)</p>
            <h4 class="brand-color">{{$topStats['totalDistance']  ?? null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-running.svg')}}" alt="">
            <p># of Accelerations(>0.5 m/s²)</p>
            <h4 class="brand-color">{{$topStats['noOfAcceleration1']  ?? null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-speedometer.svg')}}" alt="">
            <p># of Accelerations(>3 m/s²)</p>
            <h4 class="brand-color">{{$topStats['noOfAcceleration2']  ?? null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-running.svg')}}" alt="">
            <p># of Decelerations(>0.5 m/s²)</p>
            <h4 class="brand-color">{{$topStats['noOfDeceleration1']  ?? null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-distance.svg')}}" alt="">
            <p># of Decelerations(>3 m/s²)</p>
            <h4 class="brand-color">{{$topStats['noOfDeceleration2'] ?? null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-clock.svg')}}" alt="">
            <p># of Sprints(>19.8 km/h)</p>
            <h4 class="brand-color">{{$topStats['noOfSprints'] ?? null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-reverse.svg')}}" alt="">
            <p>HID Distance(>19.8 km/h)</p>
            <h4 class="brand-color">{{$topStats['hidDistance'] ?? null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-load.svg')}}" alt="">
            <p>Avg. Speed(km/h)</p>
            <h4 class="brand-color">{{ isset($topStats['avgSpeed']) ? formateNumber($topStats['avgSpeed']/2) : null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-load.svg')}}" alt="">
            <p>Max Speed(km/h)</p>
            <h4 class="brand-color">{{$topStats['maxSpeed']  ?? null}}</h4>
        </div>
        <div class="values col"> <img src="{{asset('images/icon-load.svg')}}" alt="">
            <p>Max Acceleration(m/s²)</p>
            <h4 class="brand-color">{{$topStats['maxAcceleration']  ?? null}}</h4>
        </div>
    </div>
</div>

<div class="container-box mt-4">
    <div class="row">
        <div class="col">1 MINUTE INTERVALS</div>

            <player-min-interval-component  ></player-min-interval-component>

    </div>
    <div class="box-charts mt-3"> <img class="w100" src="images/chart1.png" alt=""> </div>
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col-md-6"><heatmap-component period="1"></heatmap-component></div>
        <div class="col-md-6"><heatmap-component period="2"></heatmap-component></div>
    </div>
    <div class="box-charts mt-3"> <img class="w100" src="images/heatmap.png" alt=""> </div>
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col"><b>Intensity vs Time</b></div>
            </div>
            <div>
                <intensity-component></intensity-component>
            </div>

        </div>
        <div class="col">
            <?php if (isset($topStats['totalDistance']) && !empty($topStats['totalDistance'])) { ?>
            <div class="row">
                <div class="col"><b>Distances Per Zone</b></div>
            </div>
            <div class="box-charts mt-3">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Total</th>
                        <th scope="col">{{$topStats['totalDistance'] }} km</th>
                        <th scope="col">100%</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Distance Covered zone A1:</td>
                        <td>{{$playerStats->distancePerZone->distance_zone_a1}} km</td>
                        <td>{{calculatePercentage($topStats['totalDistance'] ,$playerStats->distancePerZone->distance_zone_a1)}} %</td>
                    </tr>
                    <tr>
                        <td>Distance Covered zone A2:</td>
                        <td>{{$playerStats->distancePerZone->distance_zone_a2}} km</td>
                        <td>{{calculatePercentage($topStats['totalDistance'] ,$playerStats->distancePerZone->distance_zone_a2)}} %</td>
                    </tr>
                    <tr>
                        <td>Distance Covered zone B1:</td>
                        <td>{{$playerStats->distancePerZone->distance_zone_b1}} km</td>
                        <td>{{calculatePercentage($topStats['totalDistance'] ,$playerStats->distancePerZone->distance_zone_b1)}} %</td>
                    </tr>
                    <tr>
                        <td>Distance Covered zone B2:</td>
                        <td>{{$playerStats->distancePerZone->distance_zone_b2}} km</td>
                        <td>{{calculatePercentage($topStats['totalDistance'] ,$playerStats->distancePerZone->distance_zone_b2)}} %</td>
                    </tr>
                    <tr>
                        <td>Distance Covered zone C1:</td>
                        <td>{{$playerStats->distancePerZone->distance_zone_c1}} km</td>
                        <td>{{calculatePercentage($topStats['totalDistance'] ,$playerStats->distancePerZone->distance_zone_c1)}} %</td>
                    </tr>
                    <tr>
                        <td>Distance Covered zone C2:</td>
                        <td>{{$playerStats->distancePerZone->distance_zone_c2}} km</td>
                        <td>{{calculatePercentage($topStats['totalDistance'] ,$playerStats->distancePerZone->distance_zone_c2)}} %</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php } ?>
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
                        <th scope="col">{{$topStats['totalDistance'] ?? null}} km</th>
                        <th scope="col">100%</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>0-15 km/h</td>
                        <td>{{$topStats['distanceSpeedRange15'] ?? null}}</td>
                        <td>{{isset($topStats['totalDistance']) ? calculatePercentage($topStats['totalDistance'],$topStats['distanceSpeedRange15']) : null}}</td>
                    </tr>
                    <tr>
                        <td>15-20 km/h</td>
                        <td>{{$topStats['distanceSpeedRange15_20']  ?? null}}</td>
                        <td>{{isset($topStats['totalDistance']) ? calculatePercentage($topStats['totalDistance'],$topStats['distanceSpeedRange15_20']) : null}}</td>
                    </tr>
                    <tr>
                        <td>20-25 km/h</td>
                        <td>{{$topStats['distanceSpeedRange20_25']  ?? null}}</td>
                        <td>{{isset($topStats['totalDistance']) ? calculatePercentage($topStats['totalDistance'],$topStats['distanceSpeedRange20_25']) : null}}</td>
                    </tr>
                    <tr>
                        <td>25-30 km/h</td>
                        <td>{{$topStats['distanceSpeedRange25_30']  ?? null}}</td>
                        <td>{{isset($topStats['totalDistance']) ? calculatePercentage($topStats['totalDistance'],$topStats['distanceSpeedRange25_30']) : null}}</td>
                    </tr>
                    <tr>
                        <td>>30 km/h</td>
                        <td>{{$topStats['distanceSpeedRangeGreater_30']  ?? null}}</td>
                        <td>{{isset($topStats['totalDistance']) ? calculatePercentage($topStats['totalDistance'],$topStats['distanceSpeedRangeGreater_30']) : null}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">

            <div class="row">
                <div class="col"><b>Distances Per Sprint (> 25 km/h)</b></div>
            </div>
            <div class="box-charts mt-3">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Distance (m)</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Max Speed km/h</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($playerStats != null && count($playerStats->distancePerSprint) > 0)
                        @foreach ($playerStats->distancePerSprint as $sprint)
                            <tr>
                                <td>{{$sprint->sprint_distance}}</td>
                                <td>{{formateDate($sprint->sprint_duration,'i:s')}}</td>
                                <td>{{$sprint->sprint_max_speed}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@stop

