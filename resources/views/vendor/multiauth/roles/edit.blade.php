@extends('multiauth::layouts.app')
@section('content')
<section class="content-header well">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Roles</li>
    </ol>
    <br>
</section>
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary well">
            <div class="panel-heading">Edit this Role</div>
            <div class="panel-body">
                <form action="{{ route('admin.role.update', $role->id) }}" method="post">
                    @csrf @method('patch')
                    <div class="form-group">
                        <label for="role">Role Name</label>
                        <input type="text" value="{{ $role->name }}" name="name" class="form-control" id="role">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Change</button>
                    <a href="{{ route('admin.roles') }}" class="btn btn-danger btn-sm float-right">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
