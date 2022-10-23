<br>
<div class="row">
	<div class="col-md-12">
		<div class="well well-sm">
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<form action="{{ route('admin.profile.update', auth('admin')->user()->id) }}" method="post" enctype="multipart/form-data">
						@csrf 
				        @method('patch')

						<div class="avatar-upload">
						    <div class="avatar-edit">
						        <input name="image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" required/>
						        <label for="imageUpload"></label>
						    </div>
						    <div class="avatar-preview">
						    	@if(isset(auth('admin')->user()->image))
						        	<div id="imagePreview" style="background-image: url('/images/admin/{{ auth('admin')->user()->image }}');">
						        	</div>
						        @else
						        	<div id="imagePreview" style="background-image: url('{{ asset('images/profile.jpg') }}');">
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
								<td><b>Full Name: </b></td>
								<td>{{ auth('admin')->user()->name }}</td>
							</tr>
							<tr>
								<td><b>Email: </b></td>
								<td>{{ auth('admin')->user()->email }}</td>
							</tr>
							<tr>
								<td><b>Phone: </b></td>
								<td>{{ auth('admin')->user()->phone }}</td>
							</tr>
							<tr>
								<td><b>Address: </b></td>
								<td>{{ auth('admin')->user()->address }}</td>
							</tr>
							<tr>
								<td><b>Member Since: </b></td>
								<td>{{ auth('admin')->user()->created_at }}</td>
							</tr>
						</table>
				</div>
			</div>
		</div>
	</div>
</div>



