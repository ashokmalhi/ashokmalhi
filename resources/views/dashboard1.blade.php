@extends('layouts.master')

@section('content')
<div class="container-box user-char mt-4">
    <div class="row">
        <div class="col">
            <p>Welcome Back!</p>
            <h2 class="brand-color"><b>Sally Mazakie</b> <img src="images/icon-hi.svg" alt=""></h2>
        </div>
        <div class="col charimg"><img src="images/chart2.svg" alt=""></div>
    </div>
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col">TIMELINE</div>
        <div class="col"></div>
    </div>
    <div class="box-charts mt-3"> <img class="w100" src="images/chart3.svg" alt=""> </div>
</div>
<div class="container-box mt-4">
    <div class="row">
        <div class="col">CHART</div>
        <div class="col"></div>
    </div>
    <div class="box-charts mt-3"> <img class="w100" src="images/chart4.svg" alt=""> </div>
</div>

@stop

