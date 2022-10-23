@extends('multiauth::layouts.app')
@section('content')
<section class="content-header well">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New Roles</li>
    </ol>
    <br>
</section>
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary well">
            <div class="panel-heading">Add New Role</div>
            <div class="panel-body">
                @include('multiauth::message')
                <form action="{{ route('admin.role.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="role">Role Name</label>
                        <input type="text" placeholder="Give an awesome name for role" name="name" class="form-control" id="role" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Store</button>
                    <a href="{{ route('admin.roles') }}" class="btn btn-sm btn-danger float-right">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection