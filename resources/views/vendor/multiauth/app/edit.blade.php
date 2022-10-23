<br>
<div class="col-md-12">
	<form action="{{ route('admin.app.update', $app->id) }}" method="post">
        @csrf 
        @method('patch')
		<fieldset class="form-group">
			<label>App Name: </label>
			<input type="text" name="name" value="{{ $app->name }}" class="form-control">
		</fieldset>

		<fieldset class="form-group">
			<label>App Category: </label>
			<input type="text" name="category" value="{{ $app->category }}" class="form-control">
		</fieldset>

		<fieldset class="form-group">
			<label>Moto: </label>
			<input type="text" name="moto" value="{{ $app->moto }}" class="form-control">
		</fieldset>

		<fieldset class="form-group">
			<label>Location: </label>
			<input type="text" name="location" value="{{ $app->location }}" class="form-control">
		</fieldset>

		<fieldset class="form-group">
			<label>Details: </label>
			<textarea type="text" name="details" class="form-control" rows="5">{{ $app->details }}</textarea>
		</fieldset>

		<fieldset class="form-group">
			<button type="Update" class="btn btn-success">Update</button>
		</fieldset>
	</form>
</div>