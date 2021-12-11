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

<form action="{{ asset('admin/contact/reply_proses') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="contact_id" value="{{ Crypt::encrypt($contact->contact_id) }}">

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Contact Mail</span></label>
	<div class="col-sm-8">
		<input type="text" name="contact_email" class="form-control" readonly placeholder="Service_name" required value="{{ $contact->contact_email }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Subject</span></label>
	<div class="col-sm-8">
		<input type="text" name="contact_subject" class="form-control" readonly   required value="{{ $contact->contact_subject }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Message</span></label>
	<div class="col-sm-8">
		<textarea class="form-control" name="contact_message" readonly>{{ $contact->contact_message }}</textarea>
	</div>
</div>

<hr>

<div class="form-group row">
	<label class="col-sm-2 control-label text-right">Reply Message</span></label>
	<div class="col-sm-8">
		<textarea class="form-control konten" name="text_reply" <?php if($contact->read_status == "1") {echo "readonly"; } ?>>{{$contact->text_reply}}</textarea>
	</div>
</div><?php if($contact->read_status == "0") {?>
<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group btn-group pull-right">
			<button type="submit" name="submit" class="btn btn-success "><i class="fa fa-save"></i> Reply Mail</button>
			<input type="reset" name="reset" class="btn btn-info " value="Reset">
		</div>
	</div>
</div> <?php } ?>
</form>