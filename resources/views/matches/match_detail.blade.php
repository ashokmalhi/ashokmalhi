@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <p>{{formateDate($matchDetails->match_date,'d M Y H:i a')}}</p>
            <h3 class="brand-color iconic-text"><img src="{{asset('images/icon-stadium.svg')}}" class="" alt=""><b>{{$matchDetails->name}} - {{$data['teamDetails']->name}}</b></h3>
            <input type="hidden" id="matchId" value="{{$matchDetails->id}}">
            <input type="hidden" id="teamId" value="{{$data['teamDetails']->id}}">
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

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
                                        @php
                                            $type = 'overall';
                                        @endphp
                                        @include('matches.sub.team_stats_overall')
                                    </div>
                                    <div class="tab-pane fade" id="team1period1" role="tabpanel" aria-labelledby="team1-period2-tab">
                                        @php
                                            $overAllMatchPlayerDetails = $periodDetail['period1'];
                                            $overallSummary = $periodSummary['period1'];
                                            $type = 'period_1';
                                        @endphp
                                        @include('matches.sub.team_stats_overall')
                                    </div>
                                    <div class="tab-pane fade" id="team1period2" role="tabpanel" aria-labelledby="profile-tab">
                                        @php
                                            $overAllMatchPlayerDetails = $periodDetail['period2'];
                                            $overallSummary = $periodSummary['period2'];
                                            $type = 'period_2';
                                        @endphp
                                        @include('matches.sub.team_stats_overall')
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="individualPlayers" role="tabpanel" aria-labelledby="individual-team1-state-tab">

                        @if(count($data['individualPlayers']) > 0)
                        <ul class="list-group">

                            @foreach($data['individualPlayers'] as $player)

                            <a href="javascript:void(0)"><li id="player-{{$player->player_id}}" class="individualPlayerDetails" data-id="{{$player->player_id}}">{{$player->first_name.' '.$player->last_name}}</li></a>

                            @endforeach

                        </ul>
                        @endif

                        <div id="player-details">
                            <?php
                            $firstPlayer = isset($data['individualPlayers'][0]) ? $data['individualPlayers'][0] : "";
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
                                @include('matches.sub.individual_player_stats')
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
        
        $(".individualPlayerDetails").click(function(){
            
            matchId = $("#matchId").val();
            teamId = $("#teamId").val();
            playerId = $(this).attr("data-id");
            
            $.ajax({
                url     : "{{URL::to('matches/get_team_player_details')}}",
                method  : 'post',
                dataType : 'html',
                data    : {
                    matchId  : matchId,
                    teamId : teamId,
                    playerId : playerId
                },
                success : function(response){
                    $("#player-details").html(response);
                    // initially calling data without any filters
                    $.get(`{{route("intensity-stats")}}?player_id=${playerId}&team_id=${teamId}`, function(response) {
                        updateChart(response,charts);
                    });
                    drawChart(charts);
                }
            });

        });
    });

    playerId = $('.individualPlayerDetails').attr("data-id");
     // initially calling data without any filters
  $.get(`{{route("intensity-stats")}}?player_id=${playerId}`, function(response) {
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
                    gridLines: {
                  color: 'rgba(54, 53, 53)'
             }
                },
            ],
            xAxes: [{
                barPercentage: 0.14,
                gridLines: {
                  color: 'rgba(54, 53, 53)'
             }
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
                    stacked: true,
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

@stop

