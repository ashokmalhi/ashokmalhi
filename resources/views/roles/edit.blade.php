@extends('layouts.master')
@section('content')
<div class="container-top ">
    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2"></div>
    </div>
</div>

{!! Form::model($role, ['method' => 'PATCH', 'class' => 'form-horizontal form-label-left', 'route' => ['roles.update', $role->id]]) !!}
<h3 class="brand-color iconic-text bolder">Edit {{ $role->display_name }} Role</h3>
<h6>Enter the information of the player below.</h6>
<div class="col-md-8 mt-5">
    <div class="row">
        <div class="col">
            <div class="inputfield  mb-3">
                <label>Name</label>
                {!! Form::text('display_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="inputfield  mb-3">
                <label>Description</label>
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="inputfield  mb-3">
                <label>Permissions</label>

                <table class="table table-striped jambo_table bulk_action table table-bordered ">
                    
                    @php($section = '')
                    @php($section_loop = '')
                    @php($count = 0)
                    @php($count_range = 5)

                    @foreach($permission as $value)
                    @php($check = 'null')
                    @if($value->status == 1)
                    @php($check = $value->id)
                    @endif
                    @if($section == '')
                    <thead>
                        <tr>
                            <th align="center">Module / Permission</th>
                            <td align="center"><strong>List</strong></td>
                            <td align="center"><strong>View</strong></td>
                            <td align="center"><strong>Add</strong></td>
                            <td align="center"><strong>Update</strong></td>
                            <td align="center"><strong>Delete</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @endif
                            @php($section_loop = $value->section)
                            @if($section == '' || $section_loop != $section)
                            @php($section = $value->section)
                            @if($count!=$count_range && $count != 0)
                            @for ($i = $count; $i < $count_range; $i++)
                            <td></td>
                            @endfor
                            @endif
                            @php($count = 0)
                        </tr>
                        <tr>
                            <td>{{ $value->section }}</td>
                            @php($section = $section_loop)
                            @endif
                            <td align="center">
                                <label>

                                    @if($check != 'null')
                                    {!! Form::checkbox('permission[]', $check, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) !!}
                                    @endif

                                </label>
                            </td>
                            @php($count++)
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="inputfield mb-3">
    <input type="submit" class="btn btn-primary btn-lg bigbtn mb-2" value="Update Role">
</div>
</div>
{!! Form::close() !!}

@endsection
