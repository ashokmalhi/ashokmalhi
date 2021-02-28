<div class="header">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.navigation')
            <div class="col-md-3 "><a href="{{URL::to('statistics/create')}}" class="btn btn-primary">Upload New Data</a></div>
            <div class="col-md-2 user-header text-end">
                <div class="userarea float-right">
                    <div class="colleft w-32"><img src="images/user.png" alt=""></div>
                    <div class="colright">{{Auth::user()->name}}<small>Admin Account</small></div>
                </div>
            </div>
        </div>
    </div>
</div>