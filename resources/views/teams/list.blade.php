@extends('layouts.master')

@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10">
            <h3 class="brand-color iconic-text"><b>All Teams</b></h3>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
    <a href="/teams/create" class="btn btn-primary" style='float: right;'>Add Team</a>
<div class="container-box mt-4">
    <div class="box-charts mt-3">
        
        <table class="table" id="teams_table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
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
            "data":{ _token: "{{csrf_token()}}"}
        },
        "columns": [
            { "data": "name" },
            { "data": "image" },
        ]
      });
    });
</script>
@endsection
@stop

