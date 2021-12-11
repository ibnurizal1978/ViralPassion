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
	<label class="col-sm-2 control-label text-right">Active Status</label>
	
	<div class="col-sm-3">
		<select name="active_status" class="form-control">
			<option value="1">Active</option>
			<option value="0">Inactive</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Service Name</span></label>
	<div class="col-sm-3">
		<input type="text" name="service_name" class="form-control" placeholder="Service_name" required value="{{ old('service_name') }}">
		
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
