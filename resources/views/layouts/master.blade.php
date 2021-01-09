<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="Hugo 0.79.0">
        <title>Dashboard</title>
        <!-- Bootstrap core CSS -->
        <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::to('css/style.css')}}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid ">
            <div class="row fullpage">
                <div class="col-md-2 darkblack p-4">
                    <div class="logo"><img src="{{URL::to('images/logo.svg')}}" alt=""></div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        @include('layouts.header')
                        <div class="container mt-4 mb-4">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{URL::to('js/jquery.min.js')}}"></script>
        <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
        <script src="{{URL::to('js/main.js')}}"></script>
    </body>
</html>
