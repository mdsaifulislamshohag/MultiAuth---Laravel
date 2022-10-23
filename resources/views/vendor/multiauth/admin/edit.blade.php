@extends('multiauth::layouts.app') 
@section('content')
<section class="content-header well">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Admin</li>
    </ol>
    <br>
</section>
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary well">
            <div class="panel-heading">Edit details of {{$admin->name}}</div>
            <form action="{{route('admin.update',[$admin->id])}}" method="post">
                @csrf @method('patch')
                <div class="panel-body">
                    @include('multiauth::message')
                    <input type="hidden" name="id" value="{{ $admin->id }}">
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Name</label>
                        <input type="text" value="{{ $admin->name }}" name="name" class="form-control col-md-6" id="role">
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Email</label>
                        <input type="text" value="{{ $admin->email }}" name="email" class="form-control col-md-6" id="role">
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Phone</label>
                        <input type="number" value="{{ $admin->phone }}" name="phone" class="form-control col-md-6" id="role">
                    </div>
                    <div class="form-group row">
                        <label for="role_id" class="col-md-4 col-form-label text-md-right">Assign Role</label>
                        <select name="role_id[]" id="role_id" class="form-control col-md-6 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" multiple>
                            <option selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                @if (in_array($role->id,$admin->roles->pluck('id')->toArray()))
                                selected
                                @endif >{{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('role_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-sm btn-primary">
                    Change
                    </button>
                    <a href="{{ route('admin.show') }}" class="btn btn-danger btn-sm float-right">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection