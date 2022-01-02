<div class="header">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.player.navigation')

            <div class="col-md-2 user-header text-end">
                <div class="userarea float-right">
                    <div class="colleft w-32">
                        @if(!empty(session('player.image_path')))
                            <img src="{{URL::to('storage/'.session('player.image_path'))}}" width="50" alt="">
                        @else
                            <img src="{{URL::to('images/user.png')}}" alt="">
                        @endif
                    </div>
{{--                    <div class="colright">{{Auth::user()->name}}--}}
{{--                        <small>Admin Account</small>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
