@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <p>{{formateDate($matchDetails->match_date,'d M Y H:i a')}}</p>
            <h3 class="brand-color iconic-text"><img src="images/icon-stadium.svg" class="" alt=""><b>{{$matchDetails->name}}</b></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#gamePeriods" type="button" role="tab" aria-controls="home" aria-selected="true">Game Periods</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#teamStats" type="button" role="tab" aria-controls="profile" aria-selected="false">Team Statistics</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#individualPlayers" type="button" role="tab" aria-controls="contact" aria-selected="false">Individual Players</button>
    </li>
</ul>

<div class="container-box mt-4">

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="gamePeriods" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="brand-color iconic-text">Period 1</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sensor</th>
                                <th scope="col">Player no</th>
                                <th scope="col">Player</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Practice Match 1</td>
                                <td>Practice</td>
                                <td>Oct 31, 2018 18:57</td>
                                <td>Europe/Zurich</td>
                                <td>Europe/Zurich</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4 class="brand-color iconic-text">Period 2</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sensor</th>
                                <th scope="col">Player no</th>
                                <th scope="col">Player</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Practice Match 3</td>
                                <td>Practice</td>
                                <td>Oct 31, 2018 18:57</td>
                                <td>Europe/Zurich</td>
                                <td>Europe/Zurich</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="teamStats" role="tabpanel" aria-labelledby="profile-tab">

        </div>
        <div class="tab-pane fade" id="individualPlayers" role="tabpanel" aria-labelledby="contact-tab">

        </div>
    </div>

</div>
@stop

