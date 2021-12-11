<p class="text-right">
  <a href="{{ asset('admin/pages') }}" class="btn btn-success btn-sm">
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

<form action="{{ asset('admin/pages/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<div class="row form-group">
  <label class="col-md-2">Title</label>
  <div class="col-md-6">
    <input type="text" name="title" class="form-control form-control-lg" placeholder="Title" required="required" value="{{ old('title') }}">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-2">Summary</label>
  <div class="col-md-6">
    <textarea name="summary" class="form-control" placeholder="Summary">{{ old('summary') }}</textarea>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Active Status</label>
  <div class="col-md-2">
    <select name="active_status" class="form-control select2">
      <option value="1">Active</option>
      <option value="0">Inactive</option>}
    </select>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Content</label> 
  <div class="col-md-9">
    <textarea name="content" class="form-control konten">{{ old('content') }}</textarea>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2"></label>
  <div class="col-md-9">
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-success "><i class="fa fa-save"></i> Submit</button>
      <input type="reset" name="reset" class="btn btn-info " value="Reset">
    </div>
  </div>
</div>
</form>

