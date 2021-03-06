@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <h3 class="brand-color iconic-text"><b>All Players </b></h3>
        </div>
        <div class="col-md-2">  <a href="/players/create" class="btn btn-primary" style='float: right;'>Add Player</a></div>
    </div>
</div>

<div class="container-box mt-4">
    <div class="box-charts mt-3">

        <table class="table" id="palyers_table">
            <thead>
                <tr>
                    <th scope="col">Player No</th>
                    <th scope="col">Player</th>
                    <th scope="col">Height(cm)</th>
                    <th scope="col">Weight(kg)</th>
                    <th scope="col">Max HR (bpm)</th>
                    <th scope="col">Max Speed (km/h)</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!--<div class="container-box mt-4">
  <div class="row">
        <div class="col"><h4>Table</h4></div>
        <div class="col"></div>
    </div>
<div class="d-flex align-items-start leftsorting">
  <div class="nav col-md-2 flex-column nav-pills me-3 leftsortingtabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <a class="active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"  role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
    <a class="" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"  role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
    <a class="" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"  role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
    <a class="" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"  role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
  </div>
  <div class="tab-content col-md-10" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
      <div class="box-charts mt-3">1</div>
    </div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"><div class="box-charts mt-3">2</div></div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"><div class="box-charts mt-3">3</div></div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"><div class="box-charts mt-3">4</div></div>
  </div>
</div>
</div>-->
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
