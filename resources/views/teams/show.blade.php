@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@if (Session::has('success'))
   <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::has('error'))
   <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif
<form action="#" method="POST" id="addTeam" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="id" value="{{$team['id']}}">
    <h3 class="brand-color iconic-text bolder">Team {{$team['id']}}</h3>

    <div class="col-md-8 mt-5">
        <div class="uploadimg mb-5">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="imgplaceholder  justify-content-center d-flex align-items-center">
                        @if(!empty($team->image))
                        <img src="{{URL::to('storage/'.$team['image'])}}" alt="">
                        @else
                        <img src="{{URL::to('images/user.svg')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center "></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Name</label>
                    <input readOnly type="text" name="name" value="{{$team['name']}}" class="form-control" placeholder="Enter team name here">
                </div>
            </div>
            <div class="col">
                <div class="inputfield mb-3">
                    <label>Sport</label>
                    <select readOnly name="sport_id" class="form-select">
                        <option value="1">Football</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
    </div>
</form>

            <div class="container-box mt-4">
                <div class="row">
                    <div class="col"><b>Team Members</b></div>
                   
                </div>
                <div class="box-charts mt-3">
                
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($team['team_player']) > 0)
                            @foreach ($team['team_player'] as $player)
                            <tr>
                                <td>{{$player['player']['first_name'].' '.$player['player']['last_name']}}</td>
                                <td>{{$player['player']['email']}}</td>
                                <td>
                                    @if($player['is_coach'])
                                    Coach
                                    @elseif($player['is_manager'])
                                    Team Manager
                                    @else
                                    Player
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
            
                </div>
            </div>

@stop
@section('scripts')
<link href="{{URL::to('css/jquery-ui.css')}}" rel="stylesheet">
<script src="{{URL::to('js/jquery-ui.js')}}"></script>
@endsection
