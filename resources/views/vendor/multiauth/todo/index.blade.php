@extends('multiauth::layouts.app')
@section('content')
<section class="content-header well">
	<h1>
	Dashboard
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">To Do List</li>
	</ol>
	<br>
</section>
<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-primary well">
		<div class="panel-heading">
			<span class="pull-left">
				Items To Do
			</span>
			{{-- <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addtodo">Add New</button> --}}
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			@include('multiauth::message')
			<table class="table table-hover table-responsive table-striped">
				<form action="{{ route('todo.add') }}" method="POST" accept-charset="utf-8">
					@csrf
					<input type="text" name="task" class="form-control" placeholder="Add New Task">
				</form>
				<tbody>
					@foreach($tasks as $task)
					<tr>
						<td width="15px;">
							<form action="{{ route('todo.status', $task->id ) }}" method="post">
						        @csrf 
						        @method('patch')
								<button type="submit" class="btn @if($task->status == 0) btn-default @else btn-success @endif btn-xs">
									<i class="fa @if($task->status == 0) fa-square @else fa-check @endif"></i>
								</button>
							</form>
						</td>
						<td>
							@if($task->status == 0)
								{{ $task->task }}
							@else
								<del style="opacity: 0.7;">{{ $task->task }}</del>
							@endif
						</td>
						<td class="pull-right">
							<form action="{{ route('todo.delete',[Crypt::encrypt($task->id)]) }}" method="POST">
								@csrf @method('delete')
								<a href="#" data-target="#my_modal"
									data-toggle="modal"
									class="edit btn btn-xs btn-default"
									data-id="{{ $task->id }}"
									data-task="{{ $task->task }}"
									>
									<i class="fa fa-edit"></i>
								</a>
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


{{-- Modal for Edit --}}
<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
	<div class="modal-dialog" role="dialog">
		<div class="modal-content">
			<form action="{{ route('todo.update') }}" method="post">
		        @csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Modal Title</h4>
				</div>
				<div class="modal-body">
					
					<input type="hidden" name="id" id="id" value="" />
					<fieldset class="form-group">
						<input type="text" name="task" class="form-control" id="task">
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function () {
		$(".edit").click(function () {
			var id = $(this).data('id');
			var task = $(this).data('task');
			$(".modal-body #id").val(id);
			$(".modal-body #task").val(task);
		})
	});
</script>
@endsection