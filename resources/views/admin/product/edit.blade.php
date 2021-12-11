<p class="text-right">
	<a href="{{ asset('admin/product') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Back
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

<form action="{{ asset('admin/product/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="product_id" value="{{ $product->product_id }}">




<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Service Name</span></label>
	<div class="col-sm-5">
		<select name="services_id" class="form-control">
			<?php foreach($services as $service) { ?>
		        <option value="<?php echo $service->services_id ?>" <?php if($product->service_id ==$service->services_id) { echo "selected"; } ?>>
		          <?php echo $service->services_name ?>
		        </option>
		      <?php } ?>
		</select>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Type Name</span></label>
	<div class="col-sm-5">
		<select name="tipe_id" class="form-control">
			<?php foreach($type as $tipe) { ?>
		        <option value="<?php echo $tipe->tipe_id ?>" <?php if($product->tipe_id ==$tipe->tipe_id) { echo "selected"; } ?>>
		          <?php echo $tipe->nama_tipe ?>
		        </option>
		      <?php } ?>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Product Name</span></label>
	<div class="col-sm-5">
		<input type="text" name="product_name" class="form-control" placeholder="Product Name" required value="{{ $product->product_name }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">ID SMM</span></label>
	<div class="col-sm-5">
		<input type="text" name="product_id_smm" class="form-control" placeholder="ID SMM" required value="{{ $product->product_id_smm }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Product Price</span></label>
	<div class="col-sm-5">
		<input type="text" name="product_price" class="form-control" placeholder="Product Price" required value="{{ $product->product_price }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Product Qty</span></label>
	<div class="col-sm-5">
		<input type="text" name="product_qty" class="form-control" placeholder="Product Qty" required value="{{ $product->product_qty }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Product Description</span></label>
	<div class="col-sm-8">
		<textarea name="product_description" class="form-control konten" required>{{ $product->product_description }}</textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Selected Product</label>	
	<div class="col-sm-5">
		<select name="selected_product" class="form-control">
			<option value="0" <?php if($product->selected_product == "0"){ echo "selected"; } ?>>Inactive</option>
			<option value="1" <?php if($product->selected_product == "1"){ echo "selected"; } ?>>Active</option>
		</select>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Featured Product</label>	
	<div class="col-sm-5">
		<select name="featured_product" class="form-control">
			<option value="0" <?php if($product->featured_product == "0"){ echo "selected"; } ?>>Inactive</option>
			<option value="1" <?php if($product->featured_product == "1"){ echo "selected"; } ?>>Active</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Active Status</label>	
	<div class="col-sm-5">
		<select name="active_status" class="form-control">
			<option value="1" <?php if($product->active_status == "1"){ echo "selected"; } ?>>Active</option>
			<option value="0" <?php if($product->active_status == "0"){ echo "selected"; } ?>>Inactive</option>
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