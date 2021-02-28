@extends('layouts.master')

@section('content')


        <form action="{{route('stats-upload')}}" method="post" id="add-team" enctype="multipart/form-data">
            @csrf
            <h3 class="brand-color iconic-text bolder">Statistics</h3>
            <h6>Upload the stats below.</h6>

            <div class="col-md-5 mt-5">
                <div class="inputfield  mb-5">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Stats Name">
                </div>
                <div class="inputfield mb-5">
                    <label>Upload CSV</label>
                    <input type="file" name="file" class="form-control">
                </div>
                <div class="inputfield mb-3">
                    <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Upload Stats">
                </div>
            </div>
        </form>

@stop
