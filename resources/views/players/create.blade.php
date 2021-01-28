@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <h3 class="brand-color iconic-text"><b>New Player</b></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<div class="container-box mt-4">
    <div class="box-charts mt-3">
    <form action="{{route('players.store')}}" method="post" id="add-player" enctype="multipart/form-data">
        @csrf
        <div class="loginform">
            <p>Enter New Player Details.</p>
            <div class="form-floating mb-3">
                <input type="text" name="first_name" class="form-control">
                <label>First Name</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="text" name="last_name" class="form-control">
                <label>Last Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="email" class="form-control">
                <label>Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" name="image" class="form-control">
                <label>Image</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" name="date_of_birth" class="form-control">
                <label>Date of Birth</label>
            </div>
            <div class="form-floating mb-3">
                <select name="gender" class="form-contro">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <label>Gender</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="number" name="height" class="form-control">
                <label>Height</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="number" name="weight" class="form-control">
                <label>Weight</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="number" name="max_heart_rate" class="form-control">
                <label>Max Heart Rate</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="number" name="target_heart_rate" class="form-control">
                <label>Target Heart Rate</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="number" name="max_speed" class="form-control">
                <label>Max Speed</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="checkbox" name="track_heart_rate">
                <label>Track Heart Rate</label>
            </div>
            <div class="inputfield mb-3">
                <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Save">
            </div>
        </div>
    </form>    
    </div>
</div>
@stop

