@extends('layouts.master')

@section('content')
<form action="{{route('teams.store')}}" method="post" id="addTeam" enctype="multipart/form-data">

    @csrf
    <h3 class="brand-color iconic-text bolder">Add new team</h3>
    <h6>Enter the information of the team below.</h6>
    
    <div class="col-md-8 mt-5">
        <div class="uploadimg mb-5">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="imgplaceholder  justify-content-center d-flex align-items-center"><img src="{{URL::to('images/user.svg')}}" alt=""></div>
                </div>
                <div class="col-md-8 d-flex align-items-center "><input type="file" name="image" class="custom-file-input btn btn-primary"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter team name here">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="inputfield mb-3">
                    <label>Sport</label>
                    <select name="sport_id" class="form-select">
                        <option value="1">Football</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="inputfield mb-3">
            <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Add Team">
        </div>
    </div>
</form>

@stop

