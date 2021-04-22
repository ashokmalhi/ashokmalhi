@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-8">
            <h3 class="brand-color iconic-text"><b>All Players </b></h3>
        </div>
        <div class="col-md-2">  <a href="/players/create" class="btn btn-primary" style='float: right;'>Add Player</a></div>
        <div class="col-md-2">  <a href="/players/upload" class="btn btn-primary" style='float: right;'>Upload Players</a></div>
    </div>
</div>
@if (Session::has('success'))
   <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::has('error'))
   <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<form action="{{route('players.index')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
@csrf
    <div class="row">
        <div class="col">
            <div class="inputfield  mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name to search">
            </div>
        </div>
        <div class="col">
            <div class="inputfield  mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name to search">
            </div>
        </div>
        <div class="col">
            <div class="inputfield  mb-3">
                <label>Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter email to search">
            </div>
        </div>
        <div class="col">
            <div class="inputfield  mb-3">
            <label></label>
            <input type="submit" class="btn btn-primary" id="search-form" style="margin-top: 25px;" value="Filter">
            <input type="submit" class="btn btn-primary" id="reset-form" style="margin-top: 25px;" value="Reset">
            </div>
        </div>
    </div>
</form>

<div class="container-box mt-4">
    <div class="box-charts mt-3">

        <table class="table" id="palyers_table">
            <thead>
                <tr>
                    <th scope="col">Player No</th>
                    <th scope="col">Player</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Height(cm)</th>
                    <th scope="col">Weight(kg)</th>
<!--                    <th scope="col">Max HR (bpm)</th>
                    <th scope="col">Max Speed (km/h)</th>-->
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@section('scripts')
<script>
$(document).ready(function () {

      var utable = $('#palyers_table').DataTable({
        "bSort": false,
        "bFilter": false,
        "iDisplayLength": 25,
        "processing": true,
        "serverSide": true,
        language: {
            processing: 'Processing...'
        },
        "ajax":{
            "url": "{{ url('/all_players') }}",
            "dataType": "json",
            "type": "POST",
            "data": function ( d ) { 
                d._token = "{{csrf_token()}}",
                d.first_name = $("#first_name").val(),
                d.last_name = $("input[name='last_name']").val(),
                d.email = $("input[name='email']").val()
            }
        },
        "columns": [
            { "data": "player_no" },
            { "data": "player_name" },
            { "data": "email" },
            { "data": "mobile" },
            { "data": "height" },
            { "data": "weight" },
            //{ "data": "max_heart_rate" },
           // { "data" : "max_speed"},
            { "data" : "actions"}
        ]
      });

    });

    $('#search-form').on('click', function(e) {   
        e.preventDefault();
        var table = $('#palyers_table').DataTable();
        table.ajax.reload();
    });

    $('#reset-form').on('click', function(e) {
        $("#first_name").val("");
        $("#last_name").val("");
        $("#email").val("");
        e.preventDefault();
        var table = $('#palyers_table').DataTable();
        table.ajax.reload();
    });

</script>
@endsection
@stop
