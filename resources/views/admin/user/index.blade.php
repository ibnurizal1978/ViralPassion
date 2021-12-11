@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<p>
  @include('admin/user/tambah')
</p>
<form action="{{ asset('admin/user/proses') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<div class="row">

  <div class="col-md-12">
    <div class="btn-group">
     
        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#Tambah">
            <i class="fa fa-plus"></i> Add User
        </button>
   </div>
</div>
</div>

<div class="clearfix"><hr></div>
<div class="table-responsive mailbox-messages">
    <div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
<thead>
    <tr>
        <th width="5%">No</th>
        <th width="30%">Full Name</th>
        <th width="30%">Username</th>
        <th width="20%">Level</th>
        <th>Action</th>
</tr>
</thead>
<tbody>

    <?php $i=1; foreach($user as $user) { ?>

        <td class="text-center">
        
        <small class="text-center"><?php echo $i ?></small>
    </td>
      

    <td><?php echo $user->nama ?></td>
    <td><?php echo $user->username ?></td>
    <td><?php echo $user->akses_level ?></td>
    <td>
        <div class="btn-group">
        <a href="{{ asset('admin/user/edit/'.$user->id_user) }}" 
          class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

        </div>

    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
</div>
</form>