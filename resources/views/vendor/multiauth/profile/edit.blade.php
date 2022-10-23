<br>
<div class="col-md-12">
	<form action="{{ route('admin.profile.update', auth('admin')->user()->id) }}" method="post">
        @csrf 
        @method('patch')
		<fieldset class="form-group">
			<label>Full Name: </label>
			<input type="text" name="name" value="{{ auth('admin')->user()->name }}" class="form-control" required>
		</fieldset>

		<fieldset class="form-group">
			<label>Phone Number: </label>
			<input type="text" name="phone" value="{{ auth('admin')->user()->phone }}" class="form-control">
		</fieldset>

		<fieldset class="form-group">
			<label>Address: </label>
			<textarea name="address" class="form-control">{{ auth('admin')->user()->address }}</textarea>
		</fieldset>

		<fieldset class="form-group">
			<button type="Update" class="btn btn-success">Update</button>
		</fieldset>
	</form>
</div>