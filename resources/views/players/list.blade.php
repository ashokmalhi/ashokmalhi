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
                    <th scope="col">Max HR (bpm)</th>
                    <th scope="col">Max Speed (km/h)</th>
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
        "ajax":{
            "url": "{{ url('/all_players') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: "{{csrf_token()}}"}
        },
        "columns": [
            { "data": "player_no" },
            { "data": "player_name" },
            { "data": "email" },
            { "data": "mobile" },
            { "data": "height" },
            { "data": "weight" },
            { "data": "max_heart_rate" },
            { "data" : "max_speed"},
            { "data" : "actions"}
        ]
      });
    });
</script>
@endsection
@stop
