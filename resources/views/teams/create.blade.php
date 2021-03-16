@extends('layouts.master')

@section('content')
<form action="{{route('teams.store')}}" method="post" id="addTeam" enctype="multipart/form-data">

    @csrf
    <h3 class="brand-color iconic-text bolder">Add new team</h3>
    <h6>Enter the information of the team below.</h6>
    
    <div class="col-md-8 mt-5">
        <div class="uploadimg mb-5">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="imgplaceholder  justify-content-center d-flex align-items-center"><img src="{{URL::to('images/user.svg')}}" alt=""></div>
                </div>
                <div class="col-md-8 d-flex align-items-center "><input type="file" name="image" class="custom-file-input btn btn-primary"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield  mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter team name here">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="inputfield mb-3">
                    <label>Sport</label>
                    <select name="sport_id" class="form-select">
                        <option value="1">Football</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="inputfield mb-3">
                    <label for="player">Team Member</label>
                    <select name="team_member[]" id="team_member" multiple class="form-select">
                    @foreach($players as $key => $player)
                        <option value="{{$key}}">{{$player}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="inputfield mb-3">
                    <label for="player">Coach</label>
                    <select name="coach[]" id="coach" multiple class="form-select">
                    @foreach($coaches as $key => $coach)
                        <option value="{{$key}}">{{$coach}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="inputfield mb-3">
                    <label for="player">Manager</label>
                    <select name="manager[]" id="manager" multiple class="form-select">
                    @foreach($managers as $key => $manager)
                        <option value="{{$key}}">{{$manager}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="inputfield mb-3">
            <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Add Team">
        </div>
    </div>
</form>

@stop
@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<script>
$('#team_member').multiselect({
    checkAllText: "Your text for CheckAll",
    uncheckAllText: "Your text for UncheckCheckAll",
    noneSelectedText: "Your text for NoOptionHasBeenSelected",
    selectedText: "You selected # of #" //The multiselect knows to display the second # as the total
});

$('#manager').multiselect({
    checkAllText: "Your text for CheckAll",
    uncheckAllText: "Your text for UncheckCheckAll",
    noneSelectedText: "Your text for NoOptionHasBeenSelected",
    selectedText: "You selected # of #" //The multiselect knows to display the second # as the total
});

$('#coach').multiselect({
    checkAllText: "Your text for CheckAll",
    uncheckAllText: "Your text for UncheckCheckAll",
    noneSelectedText: "Your text for NoOptionHasBeenSelected",
    selectedText: "You selected # of #" //The multiselect knows to display the second # as the total
});
</script>
@endsection
