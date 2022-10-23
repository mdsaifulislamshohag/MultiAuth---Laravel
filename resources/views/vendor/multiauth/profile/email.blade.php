<br>
<div class="col-md-12">
	<form action="{{ route('admin.profile.update', auth('admin')->user()->id) }}" method="post">
        @csrf 
        @method('patch')
		<fieldset class="form-group">
			<label>Email Address: </label>
			<input type="email" name="email" value="{{ auth('admin')->user()->email }}" class="form-control" required>
		</fieldset>

		<fieldset class="form-group">
			<label>Current Password: </label>
			<input type="password" name="password" value="" class="form-control" required>
		</fieldset>

		<fieldset class="form-group">
			<button type="Update" class="btn btn-success">Update</button>
		</fieldset>
	</form>
</div>