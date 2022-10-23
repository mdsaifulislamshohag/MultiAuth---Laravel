@extends('multiauth::layouts.app')
@section('content')
<section class="content-header well">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Roles</li>
    </ol>
    <br>
</section>
<div class="">
    <div class="col-md-12">
        <div class="panel panel-primary well">
            <div class="panel-heading">
                Admin Roles
                <span class="pull-right">
                    <a href="{{ route('admin.role.create') }}" class="btn btn-xs btn-primary">New Role</a>
                </span>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                @include('multiauth::message')
                <table class="table table-hover table-responsive table-striped">
                    <thead>
                        <tr>
                            <th width="15px;">Id</th>
                            <th>Role Name</th>
                            <th>Created At</th>
                            <th width="90px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>
                                    <form action="{{ route('admin.role.delete',$role->id) }}" method="POST">
                                        @csrf @method('delete')
                                        <a href="{{ route('admin.role.edit',Crypt::encrypt($role->id)) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
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
</div>
@endsection