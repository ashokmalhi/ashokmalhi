<div class="row">
    <div class="col-md-12">
        <h4 class="brand-color iconic-text">Team Stats</h4>
        <div class="d-flex align-items-start leftsorting">
            <div class="nav col-md-2 flex-column nav-pills me-3 leftsortingtabs" id="v-pills-tab-{{$type}}" role="tablist" aria-orientation="vertical">
                <a class="active" id="v-pills-home-tab-{{$type}}" data-bs-toggle="pill" data-bs-target="#v-pills-home-{{$type}}"  role="tab" aria-controls="v-pills-home-{{$type}}" aria-selected="true">All</a>
                <a class="" id="v-pills-profile-tab-{{$type}}" data-bs-toggle="pill" data-bs-target="#v-pills-profile-{{$type}}"  role="tab" aria-controls="v-pills-profile-{{$type}}" aria-selected="false">General</a>
                <a class="" id="v-pills-messages-tab-{{$type}}" data-bs-toggle="pill" data-bs-target="#v-pills-messages-{{$type}}"  role="tab" aria-controls="v-pills-messages-{{$type}}" aria-selected="false">Work Load</a>
                <a class="" id="v-pills-settings-tab-{{$type}}" data-bs-toggle="pill" data-bs-target="#v-pills-settings-{{$type}}"  role="tab" aria-controls="v-pills-settings-{{$type}}" aria-selected="false">Acceleration & Decceleration</a>
            </div>
            <div class="tab-content col-md-10" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home-{{$type}}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="box-charts mt-3">
                        <div class="box-charts mt-3">
                            <div class='stats_table scroller' style="overflow:auto;">
                                <table class="table" id="stats_table">
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
                                        @if(count($overAllMatchPlayerDetails)>0)
                                        @foreach($overAllMatchPlayerDetails as $detail)

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
                                        
                                        @foreach($overallSummary as $key => $detail)
                                        <tr>
                                            <td>{{!empty($detail['sensor'])??''}}</td>
                                            <td>{{$detail['players']['player_no']??''}}</td>
                                            <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                            <td>
                                                @if($key == 0)
                                                    Total
                                                @elseif($key == 1)
                                                    Average
                                                @endif
                                            </td>
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
                <div class="tab-pane fade" id="v-pills-profile-{{$type}}" role="tabpanel" aria-labelledby="v-pills-profile-tab-{{$type}}">
                    <div class="box-charts mt-3">
                        <div class='stats_table scroller' style="overflow:auto;">
                            <table class="table" id="stats_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Player Name</th>
                                        <th >Time Played</th>
                                        <th >Distance</th>
                                        <th ># of Spirits (> 25 km/h)</th>
                                        <th >Avg. Speed (km/h)</th>
                                        <th >Max Speed (km/h)</th>
                                        <th >Max Accelerations (m/s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(count($overAllMatchPlayerDetails)>0)
                                        @foreach($overAllMatchPlayerDetails as $detail)

                                        <tr>
                                            <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                            <td>{{$detail['time_played']}}</td>
                                            <td>{{$detail['distance_km']}}</td>
                                            <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                            <td>{{$detail['avg_speed_km']}}</td>
                                            <td>{{$detail['max_speed_km']}}</td>
                                            <td>{{$detail['max_acceleration']}}</td>
                                        </tr>
                                        @endforeach
                                        
                                        @foreach($overallSummary as $key => $detail)
                                        <tr>
                                            <td>
                                                @if($key == 0)
                                                    Total
                                                @elseif($key == 1)
                                                    Average
                                                @endif
                                            </td>
                                            <td>{{$detail['time_played']??''}}</td>
                                            <td>{{$detail['distance_km']}}</td>
                                            <td>{{$detail['no_of_sprint_greater_25_km']}}</td>
                                            <td>{{$detail['avg_speed_km']}}</td>
                                            <td>{{$detail['max_speed_km']}}</td>
                                            <td>{{$detail['max_acceleration']}}</td>
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
                <div class="tab-pane fade" id="v-pills-messages-{{$type}}" role="tabpanel" aria-labelledby="v-pills-messages-tab-{{$type}}">
                    <div class="box-charts mt-3">
                        <div class='stats_table scroller' style="overflow:auto;">
                            <table class="table" id="stats_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Player Name</th>
                                        <th >HID Distance (>15 km/h)</th>
                                        <th >Distance Speed Range (0-15 km/h)</th>
                                        <th >Distance Speed Range (15-20 km/h)</th>
                                        <th >Distance Speed Range (20-25 km/h)</th>
                                        <th >Distance Speed Range (25-30 km/h)</th>
                                        <th >Distance Speed Range (> 30 km/h)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(count($overAllMatchPlayerDetails)>0)
                                        @foreach($overAllMatchPlayerDetails as $detail)

                                        <tr>
                                            <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                           
                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>

                                            <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                            <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
                                            
                                        </tr>
                                        @endforeach
                                        
                                        @foreach($overallSummary as $key => $detail)
                                        <tr>
                                            <td>
                                                @if($key == 0)
                                                    Total
                                                @elseif($key == 1)
                                                    Average
                                                @endif
                                            </td>
                                            <td>{{$detail['hid_distance_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_km']}}</td>
                                            <td>{{$detail['distance_speed_range_15_20_km']}}</td>
                                            <td>{{$detail['distance_speed_range_20_25_km']}}</td>
                                            <td>{{$detail['distance_speed_range_25_30_km']}}</td>
                                            <td>{{$detail['distance_speed_range_greater_30_km']}}</td>
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
                <div class="tab-pane fade" id="v-pills-settings-{{$type}}" role="tabpanel" aria-labelledby="v-pills-settings-tab-{{$type}}">
                    <div class="box-charts mt-3">
                        <div class='stats_table scroller' style="overflow:auto;">
                            <table class="table" id="stats_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Player Name</th>
                                        <th ># of Accelerations (> 3 m/s)</th>
                                        <th ># of Accelerations (> 4 m/s)</th>
                                        <th ># of Decelerations (> 3 m/s)</th>
                                        <th ># of Decelerations (> 4 m/s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(count($overAllMatchPlayerDetails)>0)
                                        @foreach($overAllMatchPlayerDetails as $detail)

                                        <tr>
                                            <td>{{$detail['players']['first_name'].' '.$detail['players']['last_name']}}</td>
                                            <td>{{$detail['no_of_acceleration_3']}}</td>
                                            <td>{{$detail['no_of_acceleration_4']}}</td>
                                            <td>{{$detail['no_of_deceleration_3']}}</td>
                                            <td>{{$detail['no_of_deceleration_4']}}</td>
                                        </tr>
                                        @endforeach
                                        
                                        @foreach($overallSummary as $key => $detail)
                                        <tr>
                                            <td>
                                                @if($key == 0)
                                                    Total
                                                @elseif($key == 1)
                                                    Average
                                                @endif
                                            </td>
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