@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <p>Thu 23 Dec, 145min</p>
            <h3 class="brand-color iconic-text"><img src="{{URL::to('images/icon-stadium.svg')}}" class="" alt=""><b>Home Game</b></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<div class="container-box mt-4">
    <div class="userarea ">
        <div class="colleft">
            @if(!empty($player->image_path))
            <img src="{{URL::to('storage/'.$player->image_path)}}" width="50" alt="">
            @else
                <img src="{{URL::to('images/user.png')}}" alt="">
            @endif
        </div>
        <div class="colright">{{$player->first_name.' '.$player->last_name}}<small>24 Years Old</small></div>
    </div>
    <div class="counts mt-4">
        <div class="values col"> <img src="{{URL::to('images/icon-distance.svg')}}" alt="">
            <p>Total Distance</p>
            <h4 class="brand-color">6.11<small>KM</small></h4>
        </div>
        <div class="values col"> <img src="{{URL::to('images/icon-running.svg')}}" alt="">
            <p>Hard Running</p>
            <h4 class="brand-color">211<small>M</small></h4>
        </div>
        <div class="values col"> <img src="{{URL::to('images/icon-speedometer.svg')}}" alt="">
            <p>Top Speed</p>
            <h4 class="brand-color">6.1 <small>m/s</small></h4>
        </div>
        <div class="values col"> <img src="{{URL::to('images/icon-running.svg')}}" alt="">
            <p>Hard Running e...</p>
            <h4 class="brand-color">13</h4>
        </div>
        <div class="values col"> <img src="{{URL::to('images/icon-distance.svg')}}" alt="">
            <p>Red Zone</p>
            <h4 class="brand-color">6.1 <small>m/s</small></h4>
        </div>
        <div class="values col"> <img src="{{URL::to('images/icon-clock.svg')}}" alt="">
            <p>Work Rate</p>
            <h4 class="brand-color">65.1<small>m/mim</small></h4>
        </div>
        <div class="values col"> <img src="{{URL::to('images/icon-reverse.svg')}}" alt="">
            <p>Total Impacts</p>
            <h4 class="brand-color">16</h4>
        </div>
        <div class="values col"> <img src="{{URL::to('images/icon-load.svg')}}" alt="">
            <p>2D Load</p>
            <h4 class="brand-color">319</h4>
        </div>
    </div>
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col"><b>Details</b></div>
    </div>
    <div class="box-charts mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Height(cm)</th>
                    <th scope="col">Weight(kg)</th>
                    <th scope="col">Max HR (bpm)</th>
                    <th scope="col">Max Speed (km/h)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$player->height}}</td>
                    <td>{{$player->weight}}</td>
                    <td>{{$player->max_heart_rate}}</td>
                    <td>{{$player->max_speed}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col">Statistics</div>
        <div class="box-charts mt-3">
            <!-- DONUT CHART -->
            <div class="">

                <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="userType" class="canvasholder" class="chartjs-render-monitor"></canvas>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@if($stat)
<div class="container-box mt-4">

    <div class="d-flex align-items-start leftsorting">
        <div class="nav col-md-2 flex-column nav-pills me-3 leftsortingtabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"  role="tab" aria-controls="v-pills-home" aria-selected="true">All</a>
            <a class="" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"  role="tab" aria-controls="v-pills-profile" aria-selected="false">General</a>
            <a class="" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"  role="tab" aria-controls="v-pills-messages" aria-selected="false">Work Load</a>
            <a class="" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"  role="tab" aria-controls="v-pills-settings" aria-selected="false">Acceleration & Decceleration</a>
        </div>
        <div class="tab-content col-md-10" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="box-charts mt-3">
                    <div class="box-charts mt-3">
                        <div class='stats_table scroller' style="overflow:auto;">
                            <table class="table" id="stats_table">
                                <thead>
                                    <tr>
                                        <th >Sensor</th>
                                        <th >Player Position</th>
                                        <th >Time Played</th>
                                        <th >Distance</th>
                                        <th >HID Distance (>15 km/h)</th>
                                        <th >Distance Speed Range (0-15 km/h)</th>
                                        <th >Distance Speed Range (15-20 km/h)</th>
                                        <th >Distance Speed Range (20-25 km/h)</th>
                                        <th >Distance Speed Range (25-30 km/h)</th>
                                        <th >Distance Speed Range (> 30 km/h)</th>
                                        <th ># of Spirits (> 25 km/h)</th>
                                        <th >Avg. Speed (km/h)</th>
                                        <th >Max Speed (km/h)</th>
                                        <th >Max Accelerations (m/s)</th>
                                        <th ># of Accelerations (> 3 m/s)</th>
                                        <th ># of Accelerations (> 4 m/s)</th>
                                        <th ># of Decelerations (> 3 m/s)</th>
                                        <th ># of Decelerations (> 4 m/s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$stat->players->sensor_no}}</td>
                                        <td>{{$stat->players->position}}</td>
                                        <td>{{$stat->time_played}}</td>
                                        <td>{{$stat->distance_km}}</td>
                                        <td>{{$stat->hid_distance_15_km}}</td>
                                        <td>{{$stat->distance_speed_range_15_km}}</td>
                                        <td>{{$stat->distance_speed_range_15_20_km}}</td>
                                        <td>{{$stat->distance_speed_range_20_25_km}}</td>
                                        <td>{{$stat->distance_speed_range_25_30_km}}</td>
                                        <td>{{$stat->distance_speed_range_greater_30_km}}</td>
                                        <td>{{$stat->no_of_spirits_greater_25_km}}</td>
                                        <td>{{$stat->avg_speed_km}}</td>
                                        <td>{{$stat->max_speed_km}}</td>
                                        <td>{{$stat->max_acceleration}}</td>
                                        <td>{{$stat->no_of_acceleration_3}}</td>
                                        <td>{{$stat->no_of_acceleration_4}}</td>
                                        <td>{{$stat->no_of_deceleration_3}}</td>
                                        <td>{{$stat->no_of_deceleration_4}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="box-charts mt-3">
                    <div class='stats_table scroller' style="overflow:auto;">
                        <table class="table" id="stats_table">
                            <thead>
                                <tr>
                                    <th >Time Played</th>
                                    <th >Distance</th>
                                    <th ># of Spirits (> 25 km/h)</th>
                                    <th >Avg. Speed (km/h)</th>
                                    <th >Max Speed (km/h)</th>
                                    <th >Max Accelerations (m/s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$stat->time_played}}</td>
                                    <td>{{$stat->distance_km}}</td>
                                    <td>{{$stat->no_of_spirits_greater_25_km}}</td>
                                    <td>{{$stat->avg_speed_km}}</td>
                                    <td>{{$stat->max_speed_km}}</td>
                                    <td>{{$stat->max_acceleration}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <div class="box-charts mt-3">
                    <div class='stats_table scroller' style="overflow:auto;">
                        <table class="table" id="stats_table">
                            <thead>
                                <tr>
                                    <th >HID Distance (>15 km/h)</th>
                                    <th >Distance Speed Range (0-15 km/h)</th>
                                    <th >Distance Speed Range (15-20 km/h)</th>
                                    <th >Distance Speed Range (20-25 km/h)</th>
                                    <th >Distance Speed Range (25-30 km/h)</th>
                                    <th >Distance Speed Range (> 30 km/h)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$stat->hid_distance_15_km}}</td>
                                    <td>{{$stat->distance_speed_range_15_km}}</td>
                                    <td>{{$stat->distance_speed_range_15_20_km}}</td>
                                    <td>{{$stat->distance_speed_range_20_25_km}}</td>
                                    <td>{{$stat->distance_speed_range_25_30_km}}</td>
                                    <td>{{$stat->distance_speed_range_greater_30_km}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <div class="box-charts mt-3">
                    <div class='stats_table scroller' style="overflow:auto;">
                        <table class="table" id="stats_table">
                            <thead>
                                <tr>
                                    <th ># of Accelerations (> 3 m/s)</th>
                                    <th ># of Accelerations (> 4 m/s)</th>
                                    <th ># of Decelerations (> 3 m/s)</th>
                                    <th ># of Decelerations (> 4 m/s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$stat->no_of_acceleration_3}}</td>
                                    <td>{{$stat->no_of_acceleration_4}}</td>
                                    <td>{{$stat->no_of_deceleration_3}}</td>
                                    <td>{{$stat->no_of_deceleration_4}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@stop

@section('scripts')
<script>

    response = '[{"label":["00:00","00:15","00:30","00:45","01:00","01:15"],"value":[4,5,2,1,8,7]},{"label":["00:00","00:15","00:30","00:45","01:00","01:15"],"value":[4,5,2,1,8,7]},{"label":["00:00","00:15","00:30","00:45","01:00","01:15"],"value":[4,5,2,1,8,7]},{"label":["00:00","00:15","00:30","00:45","01:00","01:15"],"value":[4,5,2,1,8,7]},{"label":["00:00","00:15","00:30","00:45","01:00","01:15"],"value":[4,5,2,1,8,7]},{"label":["00:00","00:15","00:30","00:45","01:00","01:15"],"value":[4,5,2,1,8,7]}]';
    setTimeout(function () {
        response = JSON.parse(response);
        updateChart(response, charts);
    }, 1000);

    var charts = [
        {
            el: "userType", // div id
            gt: "bar", // gt => graph type
            graph: "",
            scales: {
                yAxes: [
                    {
                        display: true,
                        ticks: {
                            suggestedMin: 0, //min
                            // suggestedMax: 1000, //max
                        },
                    },
                ],
                xAxes: [{
                        barPercentage: 0.07
                    }]
            }
        }
    ];

    // initialize chart
    drawChart(charts);
</script>
@endsection