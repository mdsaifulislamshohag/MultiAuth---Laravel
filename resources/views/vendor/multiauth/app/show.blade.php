<br>
<div class="row">
	<div class="col-md-12">
		<div class="well well-sm">
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<form action="{{ route('admin.app.update', $app->id) }}" method="post" enctype="multipart/form-data">
						@csrf 
				        @method('patch')

						<div class="avatar-upload">
						    <div class="avatar-edit">
						        <input name="image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
						        <label for="imageUpload"></label>
						    </div>
						    <div class="avatar-preview">
						    	@if(isset($app->image))
						        	<div id="imagePreview" style="background-image: url('{{ asset("images/app/$app->image") }}');">
						        	</div>
						        @else
						        	<div id="imagePreview" style="background-image: url('{{ asset('images/logo.png') }}');">
						        	</div>
						        @endif
						    </div>
						</div>

						<input type="submit" class="btn btn-success form-control" value="UPDATE APP LOGO">
							
					</form>
				</div>
				<div class="col-sm-6 col-md-8">
					<table class="table table-striped">
						<tr>
							<td><b>App Name: </b></td>
							<td>{{ $app->name }}</td>
						</tr>

						<tr>
							<td><b>App Category: </b></td>
							<td>{{ $app->category }}</td>
						</tr>

						<tr>
							<td><b>Moto: </b></td>
							<td>{{ $app->moto }}</td>
						</tr>

						<tr>
							<td><b>Location: </b></td>
							<td>{{ $app->location }}</td>
						</tr>

						<tr>
							<td><b>Details: </b></td>
							<td>{{ $app->details }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



