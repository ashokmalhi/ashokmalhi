@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<form action="{{route('players.update',$id)}}" method="post" id="playerForm" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    <h3 class="brand-color iconic-text bolder">Edit player</h3>
    <h6>Enter the information of the player below.</h6>


    <div class="col-md-8 mt-5">
        <div class="uploadimg mb-5">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="imgplaceholder  justify-content-center d-flex align-items-center">
                        @if(!empty($player->image_path))
                            <img src="{{URL::to('storage/'.$player->image_path)}}" alt="">
                        @else
                            <img src="{{URL::to('images/user.svg')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center "><input type="file" name="image" class="custom-file-input btn btn-primary"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{$player->first_name}}" placeholder="Enter your first name here">
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{$player->last_name}}" placeholder="Enter your last name here">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield mb-3">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="{{$player->email}}" placeholder="Enter your email address">
                </div>
            </div>
            <div class="col">
                <div class="col">
                    <div class="inputfield  mb-3">
                        <label>Player No</label>
                        <input type="number" name="player_no" value="{{$player->player_no}}" class="form-control" placeholder="Enter Player no">
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield mb-3">
                    <label>Gender</label>
                    <select name="gender" class="form-select">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="inputfield mb-3">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{$player->date_of_birth}}" class="form-control" placeholder="Date of Birth">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Height</label>
                    <input type="number" name="height" value="{{$player->height}}" class="form-control" placeholder="Height">
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Weight</label>
                    <input type="number" name="weight" value="{{$player->weight}}" class="form-control" placeholder="Weight">
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Max Heart Rate</label>
                    <input type="number" name="max_heart_rate" value="{{$player->max_heart_rate}}" class="form-control" placeholder="Max Heart Rate">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Target Heart Rate</label>
                    <input type="number" name="target_heart_rate" value="{{$player->target_heart_rate}}" class="form-control" placeholder="Target Heart Rate">
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Max Speed</label>
                    <input type="number" name="max_speed" class="form-control" placeholder="Max Speed">
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col">
                <div class="inputfield  mb-3">
                <label>Type</label>
                <label class="radio-inline"><input type="radio" value="p" name="type" checked>Player</label>
                <label class="radio-inline"><input type="radio" value="c" name="type">Coach</label>
                <label class="radio-inline"><input type="radio" value="m" name="type">Manager</label>
                </div>
            </div>
        </div>
        <div class="form-check mb-5">
            <input class="form-check-input" type="checkbox" @if($player->track_heart_rate) checked @endif name="track_heart_rate" id="track_heart_rate">
            <label class="form-check-label" for="track_heart_rate">Track Heart Rate</label>
        </div>
        <div class="inputfield mb-3">
            <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Update Player">
        </div>
    </div>
</form>

@stop
