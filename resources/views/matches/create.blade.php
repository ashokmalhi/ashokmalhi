@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />

<form action="{{route('matches.store')}}" method="post" id="match" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <h3 class="brand-color iconic-text bolder">New Match</h3>
    <!-- <h6>Upload the stats below.</h6> -->

    <div class="col-md-8 mt-5">
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Match Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Match Name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Team 1</label>
                    <select name="first_team" class="form-select" id="first_team">
                        @foreach($teams as $team)
                        <option value="{{$team['id']}}">{{$team['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Team 2</label>
                    <select name="second_team" class="form-select" id="second_team">
                        @foreach($teams as $team)
                        <option value="{{$team['id']}}">{{$team['name']}}</option>
                        @endforeach
                    </select>

                </div>
            </div>

        </div>
        <br>
        <h4>Upload Team CSVs</h4>
        <br>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Team 1 Period 1</label>
                    <input type="file" name="file_team1_period1" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Team 2 Period 1</label>
                    <input type="file" name="file_team2_period1" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Team 1 Period 2</label>
                    <input type="file" name="file_team1_period2" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Team 2 Period 2</label>
                    <input type="file" name="file_team2_period2" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Match Date</label>
                    <div style="position: relative">
                    <input type="text" name="match_date" class="form-control datetimepicker" placeholder="Select Match Date">
                    </div>
                </div>
            </div>
        </div>

        <div class="inputfield mb-3">
            <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Create Match">
        </div>

    </div>
</form>

@stop
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>

<script>
    $(document).ready(function(){
        $('.datetimepicker').datetimepicker({
            format: 'Y-m-d H:m',
        });
    });
</script>
@endsection