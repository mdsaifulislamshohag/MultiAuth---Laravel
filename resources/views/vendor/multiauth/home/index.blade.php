@extends('multiauth::layouts.home')
@section('content')
@include('vendor.multiauth.home.title')
<section class="content">
	@include('vendor.multiauth.home.boxmenu')
	<div class="row">
		<section class="col-lg-7 connectedSortable">
			@include('vendor.multiauth.home.saleschart')
			@include('vendor.multiauth.home.salesgraph')
			@include('vendor.multiauth.home.chat')
			@include('vendor.multiauth.home.quickemail')
			
		</section>
		<section class="col-lg-5 connectedSortable">
			@include('vendor.multiauth.home.map')
			@include('vendor.multiauth.home.todo')
			@include('vendor.multiauth.home.calendar')
		</section>
	</div>
</section>
@endsection