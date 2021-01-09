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
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Statistics Date</th>
                    <th scope="col">Timezone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Practice Match 1</td>
                    <td>Practice</td>
                    <td>Oct 31, 2018 18:57</td>
                    <td>Europe/Zurich</td>
                </tr>
                <tr>
                    <td>Practice Match 2</td>
                    <td>Practice</td>
                    <td>Oct 31, 2018 18:57</td>
                    <td>Europe/Zurich</td>
                </tr>
                <tr>
                    <td>Practice Match 3</td>
                    <td>Practice</td>
                    <td>Oct 31, 2018 18:57</td>
                    <td>Europe/Zurich</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop

