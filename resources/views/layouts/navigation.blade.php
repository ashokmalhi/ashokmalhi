<div class="col-md-7">
    <div class="navigation">
        <ul>
            <li><a href="{{URL::to('dashboard')}}">Home</a></li>
            @if(Helper::check_permission('list-teams'))
                <li><a href="{{URL::to('teams')}}">Teams</a></li>
            @endif
            @if(Helper::check_permission('list-players'))
                <li><a href="{{URL::to('players')}}">Players</a></li>
            @endif
            @if(Helper::check_permission('list-statistics'))
                <li><a href="{{URL::to('statistics')}}">Statistics</a></li>
            @endif
            <li><a href="{{URL::to('logout')}}">Logout</a></li>
        </ul>
    </div>
</div>