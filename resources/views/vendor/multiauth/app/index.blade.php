@extends('multiauth::layouts.app')
@section('content')
<section class="content-header well">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">App Settings</li>
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
				<li class="active"><a data-toggle="tab" href="#info">App Info</a></li>
				<li><a data-toggle="tab" href="#edit">Edit Info</a></li>
				<li><a data-toggle="tab" href="#settings">App Settings</a></li>
			</ul>
			<div class="tab-content">
				<div id="info" class="tab-pane fade in active">
					@include('vendor.multiauth.app.show')
				</div>
				<div id="edit" class="tab-pane fade">
					@include('vendor.multiauth.app.edit')
				</div>
				<div id="settings" class="tab-pane fade">
					<h3>Menu 2</h3>
					<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection