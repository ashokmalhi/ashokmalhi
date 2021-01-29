@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <h3 class="brand-color iconic-text"><b>Statistics</b></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<div class="container-box mt-4">
    <div class="box-charts mt-3">
        <form action="{{route('stats-upload')}}" method="post" id="add-team" enctype="multipart/form-data">
            @csrf
            <div class="loginform">
                <p>Upload Stats.</p>
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control">
                    <label>Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="file" name="file" class="form-control">
                    <label>Upload CSV</label>
                </div>
                <div class="inputfield mb-3">
                    <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Upload">
                </div>
            </div>
        </form>
    </div>
</div>
@stop

