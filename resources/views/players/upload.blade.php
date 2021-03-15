@extends('layouts.master')

@section('content')

<div class="row">
    <div class="offset-md-10 col-md-2"> <a href="/UploadPlayers.csv"style='float: right;' target="_blank">Download Sample</a></div>
</div>
<form action="{{route('players-upload')}}" method="post" id="add-team" enctype="multipart/form-data">
    @csrf
    <h3 class="brand-color iconic-text bolder">Upload Players</h3>
    <h6>Upload csv to create multiple players.</h6>

    <div class="col-md-5 mt-5">
        <div class="inputfield mb-5">
            <label>Upload CSV</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="inputfield mb-3">
            <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Create Players">
        </div>
    </div>
</form>

@stop
