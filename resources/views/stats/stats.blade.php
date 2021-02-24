@extends('layouts.master')
<style>
    .dataTables_wrapper{
        width:100%;
        max-width:100%;
        overflow-x:scroll;
    }
</style>
@section('content')
<div class="">
    <div id="exTab2" class="">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <ul class="nav nav-tabs bolder">
                        <li class="active">
                            <a href="#1" data-toggle="tab">Overview</a>
                        </li>
                        <li>
                            <a href="#2" data-toggle="tab">Team Statistics</a>
                        </li>
                        <li>
                            <a href="#3" data-toggle="tab">Interactive Stats</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="tab-content ">
                    <div class="tab-pane active" id="1">

                        <div class="container-box mt-4">

                            <div class="d-flex align-items-start leftsorting">
                                <div class="nav col-md-2 flex-column nav-pills me-3 leftsortingtabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"  role="tab" aria-controls="v-pills-home" aria-selected="true">All</a>
                                    <a class="" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"  role="tab" aria-controls="v-pills-profile" aria-selected="false">General</a>
                                    <a class="" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"  role="tab" aria-controls="v-pills-messages" aria-selected="false">Work Load</a>
                                    <a class="" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"  role="tab" aria-controls="v-pills-settings" aria-selected="false">Acc & Decc</a>
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
                                                                <th >Player No</th>
                                                                <th >Player Name</th>
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
                                                            @if(count($team_player) > 0)
                                                            @foreach($team_player as $key => $stat)
                                                            <tr>
                                                                @if(!$stat->is_summary)
                                                                <td>{{$stat->players->sensor_no}}</td>
                                                                <td>{{$stat->players->player_no}}</td>
                                                                <td>{{$stat->players->full_name}}</td>
                                                                <td>{{$stat->players->position}}</td>
                                                                <td>{{$stat->time_played}}</td>
                                                                @else
                                                                <td></td><td></td><td></td>
                                                                <td><strong>
                                                                        @if($key == (count($team_player)-2) )
                                                                        Total
                                                                        @else
                                                                        Average
                                                                        @endif
                                                                    </strong>
                                                                </td>
                                                                <td></td>
                                                                @endif
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
                                                            @endforeach
                                                            @endif
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
                                                        @if(count($team_player) > 0)
                                                        @foreach($team_player as $key => $stat)
                                                        <tr>
                                                            @if(!$stat->is_summary)
                                                            <td>{{$stat->time_played}}</td>
                                                            @else
                                                            <td><strong>
                                                                    @if($key == (count($team_player)-2) )
                                                                    Total
                                                                    @else
                                                                    Average
                                                                    @endif
                                                                </strong>
                                                            </td>
                                                            @endif
                                                            <td>{{$stat->distance_km}}</td>
                                                            <td>{{$stat->no_of_spirits_greater_25_km}}</td>
                                                            <td>{{$stat->avg_speed_km}}</td>
                                                            <td>{{$stat->max_speed_km}}</td>
                                                            <td>{{$stat->max_acceleration}}</td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
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
                                                        @if(count($team_player) > 0)
                                                        @foreach($team_player as $key => $stat)
                                                        <tr>
                                                            @if(!$stat->is_summary)
                                                            <td>{{$stat->hid_distance_15_km}}</td>
                                                            @else
                                                            <td><strong>
                                                                    @if($key == (count($team_player)-2) )
                                                                    Total
                                                                    @else
                                                                    Average
                                                                    @endif
                                                                </strong>
                                                            </td>
                                                            @endif
                                                            <td>{{$stat->distance_speed_range_15_km}}</td>
                                                            <td>{{$stat->distance_speed_range_15_20_km}}</td>
                                                            <td>{{$stat->distance_speed_range_20_25_km}}</td>
                                                            <td>{{$stat->distance_speed_range_25_30_km}}</td>
                                                            <td>{{$stat->distance_speed_range_greater_30_km}}</td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
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
                                                        @if(count($team_player) > 0)
                                                        @foreach($team_player as $key => $stat)
                                                        <tr>
                                                            @if(!$stat->is_summary)
                                                                <td>{{$stat->no_of_acceleration_3}}</td>
                                                            @else
                                                            <td><strong>
                                                                    @if($key == (count($team_player)-2) )
                                                                    Total
                                                                    @else
                                                                    Average
                                                                    @endif
                                                                </strong>
                                                            </td>
                                                            @endif
                                                            <td>{{$stat->no_of_acceleration_4}}</td>
                                                            <td>{{$stat->no_of_deceleration_3}}</td>
                                                            <td>{{$stat->no_of_deceleration_4}}</td>
                                                        </tr>
                                                        @endforeach
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
                    <div class="tab-pane" id="2">
                        @foreach($team_player as $key => $player)
                        @if(!$player->is_summary)
                        <div class="container-box mt-4">
                            <div class="row">
                                <div class="col"><h4 class="fontmedium">{{$player->players->full_name}}</h4></div>
                                <div class="col"></div>
                            </div>
                            <div class="box-charts mt-3">
                                <!-- DONUT CHART -->
                                <div class="">


                                    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="userType{{$key}}" class="canvasholder" class="chartjs-render-monitor"></canvas>

                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="tab-pane" id="3">
                        <div class="container-box mt-4">
                            <div class="row">
                                <div class="col"><h4 class="fontmedium">Coming Soon</h4></div>
                                <div class="col"></div>
                            </div>
                            <div class="box-charts mt-3"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

@stop

@section('scripts')
<script>

    // initially calling data without any filters
    var team = "{{$statId}}";
    $.get(`{{route("team_stats")}}?team=${team}`, function (response) {
        updateChart(response, charts);
    });

    var charts = [
        {
            el: "userType0", // div id
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
        },
        {
            el: "userType1", // div id
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
        },
    ];

    // initialize chart
    drawChart(charts);
</script>

@endsection
