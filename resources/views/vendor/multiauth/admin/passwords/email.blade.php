@extends('multiauth::layouts.app')
@section('content')
<br>
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-primary well">
        <div class="panel-heading">
            Reset {{ ucfirst(config('multiauth.prefix')) }} Password
        </div>
        <div class="panel-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Admin Password') }}">
                @csrf
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                        required> @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span> @endif
                    </div>
                </div>
                <div class="pull-left">
                    <a href="/admin">Go back to login? </a>
                </div>
                <div class="form-group pull-right">

                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
</div>
@endsection