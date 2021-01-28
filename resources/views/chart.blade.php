@extends('layouts.master')

@section('content')

    <div class="col-md-12">
        <!-- DONUT CHART -->
        <div class="card card-danger" style="background-color:#212529">
            <div class="card-header">
                <h3 class="card-title" style="padding: 0;"> <span class="fa fa-bar-chart"></span>Volunteers</h3>

            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="userType" style="background-color: #212529; min-height: 210px; height: 240px; max-height: 350px; max-width: 100%; display: block; width: 572px;" width="715" height="312" class="chartjs-render-monitor"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-12">
        <!-- DONUT CHART -->
        <div class="card card-danger" style="background-color:#212529">
            <div class="card-header">
                <h3 class="card-title" style="padding: 0;"> <span class="fa fa-bar-chart"></span>One Minute Intervals</h3>

            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="stackChart" style="background-color: #212529; min-height: 210px; height: 240px; max-height: 350px; max-width: 100%; display: block; width: 572px;" width="715" height="312" class="chartjs-render-monitor"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@stop

@section('scripts')
<script>

  // initially calling data without any filters
  $.get(`{{route("stats")}}`, function(response) {
      updateChart(response,charts);
  });

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
    },
    {
        el: "stackChart", // div id
        gt: "bar", // gt => graph type
        graph: "",
        options: {
            scales: {
                xAxes: [{
                    stacked: true
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
        
    },
        
  ];

  // initialize chart
  drawChart(charts);
</script>

@endsection