@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<form action="{{route('coaches.update',$id)}}" method="post" id="coachForm" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    <h3 class="brand-color iconic-text bolder">Edit Coach</h3>
    <h6>Enter the information of the coach below.</h6>


    <div class="col-md-8 mt-5">
        <div class="uploadimg mb-5">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="imgplaceholder  justify-content-center d-flex align-items-center">
                        @if(!empty($coach->image_path))
                            <img src="{{URL::to('storage/'.$coach->image_path)}}" alt="">
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
                    <input type="text" name="first_name" class="form-control" value="{{$coach->first_name}}" placeholder="Enter your first name here">
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{$coach->last_name}}" placeholder="Enter your last name here">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield mb-3">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="{{$coach->email}}" placeholder="Enter your email address">
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
                    <input type="date" name="date_of_birth" value="{{$coach->date_of_birth}}" class="form-control" placeholder="Date of Birth">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Height</label>
                    <input type="number" name="height" value="{{$coach->height}}" class="form-control" placeholder="Height">
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Weight</label>
                    <input type="number" name="weight" value="{{$coach->weight}}" class="form-control" placeholder="Weight">
                </div>
            </div>
        </div>

        <div class="inputfield mb-3">
            <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Update Coach">
        </div>
    </div>
</form>

@stop
