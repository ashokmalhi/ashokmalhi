@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-8">
            <h3 class="brand-color iconic-text"><b>All Matches </b></h3>
        </div>
        <div class="col-md-2">  <a href="/matches/create" class="btn btn-primary" style='float: right;'>Add New</a></div>
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

        <table class="table" id="matches_table">
            <thead>
                <tr>
                    <th scope="col">Player Id</th>
                    <th scope="col">Match Name</th>
                    <th scope="col">Team 1</th>
                    <th scope="col">Team 2</th>
                    <th scope="col">Match Date</th>
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

      var utable = $('#matches_table').DataTable({
        "bSort": false,
        "bFilter": false,
        "iDisplayLength": 25,
        "processing": true,
        "serverSide": true,
        language: {
            processing: 'Processing...'
        },
        "ajax":{
            "url": "{{ url('/all_matches') }}",
            "dataType": "json",
            "type": "POST",
            "data": function ( d ) { 
                d._token = "{{csrf_token()}}"
            }
        },
        "columns": [
            { "data": "match_id" },
            { "data": "match_name" },
            { "data": "team_1" },
            { "data": "team_2" },
            { "data" : "match_date"},
            { "data" : "actions"}
        ]
      });

    });
    
</script>
@endsection
@stop
