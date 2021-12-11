<form action="{{ asset('admin/pages/proses') }}" method="post" accept-charset="utf-8">
<?php $site   = DB::table('konfigurasi')->first(); ?>
{{ csrf_field() }}
<p class="btn-group">

  
    <a href="{{ asset('admin/pages/tambah') }}" class="btn btn-success ">
  <i class="fa fa-plus"></i> Add Pages</a>

</p>
<div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
<thead>
    <tr>
    <th width="5%">No</th>
    <th width="25%">Page</th>
    <th width="25%">Slug URL</th>
    <th width="10%">Active Status</th>
    <th width="10%">Updated Date</th>
    <th width="15%"></th>
</tr>
</thead>
<tbody>

<?php $i=1; foreach($pages as $page) { ?>

<tr>
  <td>{{$i}}</td>
  <td>{{$page->title}}</td>
  <td>{{$page->slug_title}}</td>
  <td>{{$page->active_status == '1' ? 'Active' : 'Deactive'}}</td>
  <td>{{ $page->updated_date}}</td>
   
    <td>
      <div class="btn-group">
        <a href="{{ asset('page/'.strtolower($page->slug_title)) }}" 
        class="btn btn-success btn-sm" target="_blank"><i class="fa fa-eye"></i></a>

        <a href="{{ asset('admin/pages/edit/'.$page->id) }}" 
        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
      </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
{{$pages->links()}}
</div>
</form>