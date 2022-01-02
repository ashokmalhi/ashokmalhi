<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="Hugo 0.79.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard</title>
        <link href="{{URL::to('css/master.css')}}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid " id="app">
            <div class="row fullpage">
                <div class="col-md-2 darkblack p-4">
                    <div class="logo"><img src="{{URL::to('images/logo.png')}}" alt=""></div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        @include('layouts.player.header')
                        <div class="container main mt-4 mb-4" >
                            @guest


                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('doPlayerLogout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('doPlayerLogout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
