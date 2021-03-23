@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <p>Thu 23 Dec, 145min</p>
            <h3 class="brand-color iconic-text"><img src="images/icon-stadium.svg" class="" alt=""><b>Home Game</b></h3>
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
        <div class="colright">{{Auth::user()->name}} 
            @if(!empty($age))
                <small>{{$age}} Years Old</small>
            @endif
        </div>
    </div>
    <div class="counts mt-4">
        <div class="values col"> <img src="images/icon-distance.svg" alt="">
            <p>Total Distance</p>
            <h4 class="brand-color">6.11<small>KM</small></h4>
        </div>
        <div class="values col"> <img src="images/icon-running.svg" alt="">
            <p>Hard Running</p>
            <h4 class="brand-color">211<small>M</small></h4>
        </div>
        <div class="values col"> <img src="images/icon-speedometer.svg" alt="">
            <p>Top Speed</p>
            <h4 class="brand-color">6.1 <small>m/s</small></h4>
        </div>
        <div class="values col"> <img src="images/icon-running.svg" alt="">
            <p>Hard Running e...</p>
            <h4 class="brand-color">13</h4>
        </div>
        <div class="values col"> <img src="images/icon-distance.svg" alt="">
            <p>Red Zone</p>
            <h4 class="brand-color">6.1 <small>m/s</small></h4>
        </div>
        <div class="values col"> <img src="images/icon-clock.svg" alt="">
            <p>Work Rate</p>
            <h4 class="brand-color">65.1<small>m/mim</small></h4>
        </div>
        <div class="values col"> <img src="images/icon-reverse.svg" alt="">
            <p>Total Impacts</p>
            <h4 class="brand-color">16</h4>
        </div>
        <div class="values col"> <img src="images/icon-load.svg" alt="">
            <p>2D Load</p>
            <h4 class="brand-color">319</h4>
        </div>
    </div>
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col">1 MINUTE INTERVALS</div>
        <div class="col"></div>
    </div>
    <div class="box-charts mt-3"> <img class="w100" src="images/chart1.png" alt=""> </div>
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col">HEATMAP</div>
        <div class="col"></div>
    </div>
    <div class="box-charts mt-3"> <img class="w100" src="images/heatmap.png" alt=""> </div>
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col"><b>Recently Generated Statistics</b></div>
        <div class="col"></div>
    </div>
    <div class="box-charts mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Statistics Date</th>
                    <th scope="col">Timezone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Practice Match 1</td>
                    <td>Practice</td>
                    <td>Oct 31, 2018 18:57</td>
                    <td>Europe/Zurich</td>
                </tr>
                <tr>
                    <td>Practice Match 2</td>
                    <td>Practice</td>
                    <td>Oct 31, 2018 18:57</td>
                    <td>Europe/Zurich</td>
                </tr>
                <tr>
                    <td>Practice Match 3</td>
                    <td>Practice</td>
                    <td>Oct 31, 2018 18:57</td>
                    <td>Europe/Zurich</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop

