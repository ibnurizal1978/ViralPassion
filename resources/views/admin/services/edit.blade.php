<p class="text-right">
	<a href="{{ asset('admin/services') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Kembali
	</a>
</p>
<hr>
<?php
// Validasi error

// Error upload
if(isset($error)) {
	echo '<div class="alert alert-warning">';
	echo $error;
	echo '</div>';
}

// Form open
?>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/services/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="services_id" value="{{ $services->services_id }}">



<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Service Name</span></label>
	<div class="col-sm-3">
		<input type="text" name="service_name" class="form-control" placeholder="Service_name" required value="{{ $services->services_name }}">
		
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Upload Image For Home Page</span></label>
	<div class="col-sm-4">
		<input type="file" name="icon" class="form-control" accept="image/png" required placeholder="Icon image for home page">
	</div>
	<img src="" width="100">
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Current Image</span></label>
	<div class="col-sm-4">
	<img src="{{asset('public/upload/image/'.$services->icon)}}" width="100">
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Service Short Description</span></label>
	<div class="col-sm-4">
		<textarea name="description" class="form-control" required>{{ $services->description }}</textarea>
		
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Active Status</label>
	
	<div class="col-sm-3">
		<select name="active_status" class="form-control">
			<option value="1" <?php if($services->active_status == '1') {echo 'selected';} ?> >Active</option>
			<option value="0" <?php if($services->active_status == '0') {echo 'selected';} ?>>Inactive</option>
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