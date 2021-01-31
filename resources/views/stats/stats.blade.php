@extends('layouts.master')
<style>
.dataTables_wrapper{
 width:100%;
 max-width:100%;
 overflow-x:scroll;
}
</style>
@section('content')
<div class="container">
  <div id="exTab2" class="container">
    <div class="panel panel-default"> 
      <div class="panel-heading">
        <div class="panel-title">
          <ul class="nav nav-tabs">
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
                <div class="box-charts mt-3">
              
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
                        <!-- <th >Distance Speed Range (25-30 km/h)</th>
                        <th >Distance Speed Range (> 30 km/h)</th> -->
                        <!-- <th ># of Spirits (> 25 km/h)</th>
                        <th >Avg. Speed (km/h)</th>
                        <th >Max Speed (km/h)</th>
                        <th >Max Accelerations (m/s)</th>
                        <th ># of Accelerations (> 3 m/s)</th>
                        <th ># of Accelerations (> 4 m/s)</th>
                        <th ># of Decelerations (> 3 m/s)</th>
                        <th ># of Decelerations (> 4 m/s)</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
          <div class="tab-pane" id="2">
            <h3>Team Statistics</h3>
            @foreach($team_player as $key => $player)
              <div class="col-md-12">
                <!-- DONUT CHART -->
                <div class="card card-danger" style="background-color:#212529">
                    <div class="card-header">
                        <h3 class="card-title" style="padding: 0;"> <span class="fa fa-bar-chart"></span>Volunteers</h3>

                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="userType{{$key}}" style="background-color: #212529; min-height: 210px; height: 240px; max-height: 350px; max-width: 100%; display: block; width: 572px;" width="715" height="312" class="chartjs-render-monitor"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            @endforeach
          </div>
          <div class="tab-pane" id="3">
            <h3>add clearfix to tab-content (see the css)</h3>
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
<script>
	$(document).ready(function () {
      
      var utable = $('#stats_table').DataTable({
        "bSort": false,
        "bFilter": false,
        "iDisplayLength": 25,
        "processing": true,
        // "scrollX": true
        "serverSide": true,
        "ajax":{
            "url": "{{ url('/statistics/all_team_stats') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: "{{csrf_token()}}", team_id: "{{ $statId }}"}
        },
        "columns": [
            { "data": "sensor" },
            { "data": "player_no" },
            { "data": "player_name" },
            { "data": "player_position" },
            { "data" : "time_played"},
            { "data" : "distance"},
            { "data" : "hid_distance"},
            { "data" : "distance_speed_range_0"},
            { "data" : "distance_speed_range_15"},
            { "data" : "distance_speed_range_25"},
            // { "data" : "distance_speed_range_30"}
            // { "data" : "distance_speed_range_greater_30"}
            // { "data" : "no_of_spririts"},
            // { "data" : "avg_speed"},
            // { "data" : "max_speed"},
            // { "data" : "max_acceleration"},
            // { "data" : "no_of_accelerations_3"},
            // { "data" : "no_of_accelerations_4"},
            // { "data" : "decelerations_3"},
            // { "data" : "decelerations_4"},

        ]
      });
    });
</script>
@stop

@section('scripts')
<script>

  // initially calling data without any filters
  var team = "{{$statId}}";
  $.get(`{{route("team_stats")}}?team=${team}`, function(response) {
      updateChart(response,charts);
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