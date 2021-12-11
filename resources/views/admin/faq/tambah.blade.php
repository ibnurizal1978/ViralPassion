<p class="text-right">
	<a href="{{ asset('admin/faq') }}" class="btn btn-success btn-sm">
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

<form action="{{ asset('admin/faq/tambah_proses') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}



<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Question</span></label>
	<div class="col-sm-8">
		<textarea name="faq_question" class="form-control" required>{{ old('faq_question') }}</textarea>
		
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Answer</span></label>
	<div class="col-sm-8">
		<textarea name="faq_answer" class="form-control" required>{{ old('faq_answer') }}</textarea>
		
	</div>
</div>

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
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group btn-group pull-right">
			<button type="submit" name="submit" class="btn btn-success "><i class="fa fa-save"></i> Submit</button>
			<input type="reset" name="reset" class="btn btn-info " value="Reset">
		</div>
	</div>
</div>
</form>
