@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <h3 class="brand-color iconic-text"><b>New Team</b></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<div class="container-box mt-4">
    <div class="box-charts mt-3">
        <div class="loginform">
            <p>Enter New Team Details.</p>
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
            <div class="form-floating  mb-3">
                <input type="text" name="height" class="form-control">
                <label>Height</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="text" name="weight" class="form-control">
                <label>Weight</label>
            </div>
            <div class="inputfield mb-3">
                <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Save">
            </div>
        </div>
    </div>
</div>
@stop

