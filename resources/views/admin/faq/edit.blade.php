<p class="text-right">
	<a href="{{ asset('admin/faq') }}" class="btn btn-success btn-sm">
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

<form action="{{ asset('admin/faq/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="faq_id" value="{{ $faq->faq_id }}">



<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Question</span></label>
	<div class="col-sm-8">
		<textarea name="faq_question" class="form-control" required>{{ $faq->faq_question }}</textarea>
		
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Answer</span></label>
	<div class="col-sm-8">
		<textarea name="faq_answer" class="form-control" required>{{ $faq->faq_answer }}</textarea>
		
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Active Status</label>
	
	<div class="col-sm-3">
		<select name="active_status" class="form-control">
			<option value="1" <?php if($faq->active_status == '1') {echo 'selected';} ?> >Active</option>
			<option value="0" <?php if($faq->active_status == '0') {echo 'selected';} ?>>Inactive</option>
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