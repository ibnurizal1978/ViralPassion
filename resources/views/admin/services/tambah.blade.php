<p class="text-right">
	<a href="{{ asset('admin/services') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Back
	</a>
</p>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/services/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}


<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Service Name</span></label>
	<div class="col-sm-4">
		<input type="text" name="service_name" class="form-control" placeholder="Service Name" required value="{{ old('service_name') }}">
		
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Upload Image For Home Page</span></label>
	<div class="col-sm-4">
		<input type="file" name="icon" class="form-control" accept="image/png" required placeholder="Icon image for home page">
		
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Service Short Description</span></label>
	<div class="col-sm-4">
		<textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
		
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Active Status</label>
	
	<div class="col-sm-4">
		<select name="active_status" class="form-control">
			<option value="1">Active</option>
			<option value="0">Inactive</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group btn-group pull-right">
			<button type="submit" name="submit" class="btn btn-success "><i class="fa fa-save"></i> Submit</button>
			<input type="reset" name="reset" class="btn btn-info " value="Reset">
		</div>
	</div>
</div>
</form>
