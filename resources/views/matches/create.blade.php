@extends('layouts.master')

@section('content')


        <form action="{{route('match.store')}}" method="post" id="match" enctype="multipart/form-data">
            @csrf
            <h3 class="brand-color iconic-text bolder">Match</h3>
            <!-- <h6>Upload the stats below.</h6> -->

            <div class="col-md-5 mt-5">
                <div class="inputfield  mb-5">
                    <label>Match Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Stats Name">
                </div>
                <div class="inputfield mb-5">
                    <label>Team 1</label>
                    <select name="first_team" class="form-select">
                        @foreach($teams as $team)
                            <option value="{{$team['id']}}">{{$team['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputfield mb-5">
                    <label>Team 1</label>
                    <select name="second_team" class="form-select">
                        @foreach($teams as $team)
                            <option value="{{$team['id']}}">{{$team['name']}}</option>
                        @endforeach
                    </select>
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
