<?php
if (isset($playerStats->matchStats) && count($playerStats->matchStats) > 0) {

    $totalTimePlayed = '00:00:00';
    $totalDistance = $noOfAcceleration1 = $noOfAcceleration2 = 0;
    $noOfDeceleration1 = $noOfDeceleration2 = $noOfSprints = $hidDistance = 0;
    $avgSpeed = $maxSpeed = $maxAcceleration = 0;
    $distanceSpeedRange15 = $distanceSpeedRange15_20 = $distanceSpeedRange20_25 = $distanceSpeedRange25_30 = $distanceSpeedRangeGreater_30 = 0;

    foreach ($playerStats->matchStats as $stat) {

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
@if($playerStats)
<div class="container-box mt-4">
    <div class="userarea ">
        <div class="colright">{{$playerStats->first_name.' '.$playerStats->last_name}} 
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
                <div class="col"><b>Intensity vs Time</b></div>
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
                    <div class="col"><b>Distances Per Zone</b></div>
                </div>
                <div class="box-charts mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Total</th>
                                <th scope="col">{{$totalDistance}} km</th>
                                <th scope="col">100%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($playerStats->distancePerZone))
                            <tr>
                                <td>Distance Covered zone A1:</td>
                                <td>{{$playerStats->distancePerZone->distance_zone_a1}} km</td>
                                <td>{{calculatePercentage($totalDistance,$playerStats->distancePerZone->distance_zone_a1)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone A2:</td>
                                <td>{{$playerStats->distancePerZone->distance_zone_a2}} km</td>
                                <td>{{calculatePercentage($totalDistance,$playerStats->distancePerZone->distance_zone_a2)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone B1:</td>
                                <td>{{$playerStats->distancePerZone->distance_zone_b1}} km</td>
                                <td>{{calculatePercentage($totalDistance,$playerStats->distancePerZone->distance_zone_b1)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone B2:</td>
                                <td>{{$playerStats->distancePerZone->distance_zone_b2}} km</td>
                                <td>{{calculatePercentage($totalDistance,$playerStats->distancePerZone->distance_zone_b2)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone C1:</td>
                                <td>{{$playerStats->distancePerZone->distance_zone_c1}} km</td>
                                <td>{{calculatePercentage($totalDistance,$playerStats->distancePerZone->distance_zone_c1)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone C2:</td>
                                <td>{{$playerStats->distancePerZone->distance_zone_c2}} km</td>
                                <td>{{calculatePercentage($totalDistance,$playerStats->distancePerZone->distance_zone_c2)}} %</td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="3" style="text-align: center;">No Data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
        </div>
            </div>
        <br><br>
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
                        <div class="col"><b>Distances Per Sprint (> 25 km/h)</b></div>
                    </div>
                    <div class="box-charts mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Time</th>
                                    <th scope="col">Distance (m)</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Max Speed km/h</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($playerStats->distancePerSprint) > 0)
                                    @foreach ($playerStats->distancePerSprint as $sprint)
                                    <tr>
                                        <td>{{$sprint->sprint_time}}</td>
                                        <td>{{$sprint->sprint_distance}}</td>
                                        <td>{{$sprint->sprint_duration}}</td>
                                        <td>{{$sprint->sprint_max_speed}}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" style="text-align: center;">No Data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    @endif
</div>
