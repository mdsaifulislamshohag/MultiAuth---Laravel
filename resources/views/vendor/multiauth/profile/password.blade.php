<br>
<div class="col-md-12">
	<form action="{{ route('admin.profile.update', auth('admin')->user()->id) }}" method="post">
        @csrf 
        @method('patch')
		<fieldset class="form-group">
			<label>Old Password: </label>
			<input type="password" name="old_password" value="" class="form-control" required>
		</fieldset>

		<fieldset class="form-group">
			<label>New Password: </label>
			<input type="password" name="new_password" value="" class="form-control" required>
		</fieldset>

		<fieldset class="form-group">
			<label>Confirm Password: </label>
			<input type="password" name="confirm_password" value="" class="form-control" required>
		</fieldset>

		<fieldset class="form-group">
			<button type="Update" class="btn btn-success">Update</button>
		</fieldset>
	</form>
</div>