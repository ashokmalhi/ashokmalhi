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
            <h4 class="brand-color">{{formateNumber($avgSpeed/2)}}</h4>
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
                <div class="col"><b>Field Position Heat Map Period 1</b></div>
            </div>
            <br>
            <div id="heatmapPeriod1" style="width:100%; height:500px;" ></div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col"><b>Field Position Heat Map Period 2</b></div>
            </div>
            <br>
            <div id="heatmapPeriod2" style="width:100%; height:500px;" ></div>
        </div>
    </div>
  
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col"><b>Intensity vs Time</b></div>
            </div>
            <canvas id="userType" style="background-color: #212529; min-height: 210px; height: 200px; max-height: 350px; max-width: 100%; display: block; width: 572px;" width="715" height="470" class="chartjs-render-monitor"></canvas>
        </div>
        <div class="col">
            <?php if (isset($firstPlayer->distancePerZone) && !empty($firstPlayer->distancePerZone)) { ?>
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
                            <tr>
                                <td>Distance Covered zone A1:</td>
                                <td>{{$firstPlayer->distancePerZone->distance_zone_a1}} km</td>
                                <td>{{calculatePercentage($totalDistance,$firstPlayer->distancePerZone->distance_zone_a1)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone A2:</td>
                                <td>{{$firstPlayer->distancePerZone->distance_zone_a2}} km</td>
                                <td>{{calculatePercentage($totalDistance,$firstPlayer->distancePerZone->distance_zone_a2)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone B1:</td>
                                <td>{{$firstPlayer->distancePerZone->distance_zone_b1}} km</td>
                                <td>{{calculatePercentage($totalDistance,$firstPlayer->distancePerZone->distance_zone_b1)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone B2:</td>
                                <td>{{$firstPlayer->distancePerZone->distance_zone_b2}} km</td>
                                <td>{{calculatePercentage($totalDistance,$firstPlayer->distancePerZone->distance_zone_b2)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone C1:</td>
                                <td>{{$firstPlayer->distancePerZone->distance_zone_c1}} km</td>
                                <td>{{calculatePercentage($totalDistance,$firstPlayer->distancePerZone->distance_zone_c1)}} %</td>
                            </tr>
                            <tr>
                                <td>Distance Covered zone C2:</td>
                                <td>{{$firstPlayer->distancePerZone->distance_zone_c2}} km</td>
                                <td>{{calculatePercentage($totalDistance,$firstPlayer->distancePerZone->distance_zone_c2)}} %</td>
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
                            @if(count($firstPlayer->distancePerSprint) > 0)
                                @foreach ($firstPlayer->distancePerSprint as $sprint)
                                <tr>
                                    <td>{{$sprint->sprint_time}}</td>
                                    <td>{{$sprint->sprint_distance}}</td>
                                    <td>{{$sprint->sprint_duration}}</td>
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