@extends('layouts.master')
@section('content')
<div class="x_panel">
    <div class="x_content">
       <div class="container-top ">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="brand-color iconic-text"><b>All Roles </b></h3>
                </div>
<!--                <div class="col-md-2">  <a href="/teams/create" class="btn btn-primary" style='float: right;'>Add Team</a></div>-->
            </div>
        </div> 
        <div class="container-box mt-4">
            <div class="box-charts mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                
                                <a title="Show" class="btn btn-primary btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
                                <a title="Edit" class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                             
                            </td>
                        </tr>
                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        {!! $roles->render() !!}
    </div>
</div>
@endsection
