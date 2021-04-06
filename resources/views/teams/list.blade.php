@extends('layouts.master')

@section('content')
 <div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <h3 class="brand-color iconic-text"><b>All Teams </b></h3>
        </div>
        @if(Helper::check_permission('create-teams'))
        <div class="col-md-2">  <a href="/teams/create" class="btn btn-primary" style='float: right;'>Add Team</a></div>
        @endif
    </div>
</div>   
@if (Session::has('success'))
   <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::has('error'))
   <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif  
<form action="{{route('teams.index')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
@csrf
    <div class="row">
        <div class="col">
            <div class="inputfield  mb-3">
                <label>Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter team name">
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
        
        <table class="table" id="teams_table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
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
      
      var utable = $('#teams_table').DataTable({
        "bSort": false,
        "bFilter": false,
        "iDisplayLength": 25,
        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": "{{ url('/all_teams') }}",
            "dataType": "json",
            "type": "POST",
            "data": function ( d ) { 
                d._token = "{{csrf_token()}}",
                d.name = $("#name").val()
            }
        },
        "columns": [
            { "data": "name" },
            { "data": "image" },
            { "data": "action" },
        ]
      });
    });

    $('#search-form').on('click', function(e) {   
        e.preventDefault();
        var table = $('#teams_table').DataTable();
        table.ajax.reload();
    });

    $('#reset-form').on('click', function(e) {
        $("#name").val("");
        e.preventDefault();
        var table = $('#teams_table').DataTable();
        table.ajax.reload();
    });
</script>
@endsection
@stop

