@extends('multiauth::layouts.app')
@section('content')
<section class="content-header well">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Profile</li>
    </ol>
    <br>
</section>
<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-primary well">
		<div class="panel-heading">
			<span class="">
				Application Setting
			</span>
		</div>
		<div class="panel-body">
			@include('multiauth::message')
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#info">Profile Info</a></li>
				<li><a data-toggle="tab" href="#edit">Edit Profile</a></li>
				<li><a data-toggle="tab" href="#email">Change Email</a></li>
				<li><a data-toggle="tab" href="#password">Change Password</a></li>
			</ul>
			<div class="tab-content">
				<div id="info" class="tab-pane fade in active">
					@include('vendor.multiauth.profile.show')
				</div>
				<div id="edit" class="tab-pane fade">
					@include('vendor.multiauth.profile.edit')
				</div>
				<div id="email" class="tab-pane fade">
					@include('vendor.multiauth.profile.email')
				</div>
				<div id="password" class="tab-pane fade">
					@include('vendor.multiauth.profile.password')
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection