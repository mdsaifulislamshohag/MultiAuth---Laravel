@extends('multiauth::layouts.app')
@section('content')
<section class="content-header well">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">All Admin</li>
    </ol>
    <br>
</section>
<div class="col-md-12">
    <div class="panel panel-primary well">
        <div class="panel-heading">
            <div class="pull-left">
                All Admins <span class="btn btn-xs btn-success" style="margin-top: -3px;">Total admin-{{ count($admins) }}</span>
            </div>
            <div class="pull-right">
                <a href="{{route('admin.register')}}" class="btn btn-xs btn-primary">Add Admin</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            @include('multiauth::message')
            <table class="table table-hover table-responsive table-striped">
                <thead>
                    <tr>
                        <th width="15px;">Id</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>roles</th>
                        <th>Created At</th>
                        <th width="90px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    @php
                    if($admin->id == auth('admin')->user()->id){
                    $display = 'hidden';
                    }
                    else{
                    $display = '';
                    }
                    @endphp
                    <tr class="{{ $display }}">
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td >
                            @foreach ($admin->roles as $role)
                            <button class="btn btn-xs btn-success" style="font-weight: 700;font-size: 16px;">
                            <i>{{ $role->name }}</i>
                            </button>
                            @endforeach
                        </td>
                        <td>{{ $admin->created_at}}</td>
                        <td>
                            
                            
                            <form  action="{{ route('admin.delete',[$admin->id]) }}" method="POST" >
                                @csrf @method('delete')
                                <a href="{{route('admin.edit',[Crypt::encrypt($admin->id)])}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return deleteconfig()"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection