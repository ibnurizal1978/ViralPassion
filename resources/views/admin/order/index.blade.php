<div class="row">
<div class="col-md-6">
    <form action="{{ asset('admin/order/cari') }}" method="get" accept-charset="utf-8">
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="keywords" value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" placeholder="Keywords..." required>
      <span class="input-group-append">
            <button type="submit" name="cari" class="btn btn-info" value="cari">Search</button>
             <a href="{{ asset('admin/order') }}" class="btn btn-info ">
               Reset
            </a>
      </span>
    </div>
    </form>
</div>

</div>

<form action="{{ asset('admin/order/filter') }}" method="get" accept-charset="utf-8">
  {{ csrf_field() }}
<div class="row">
 
<div class="input-group mb-3 col-md-8">
    
    <select name="order_status" class="form-control">
      <option value="all" <?php if(isset($_GET['order_status'])) {
          if($_GET['order_status'] == "all") 
            {echo "selected";}
          }?> >All Status</option>
      <option value="Pending" <?php if(isset($_GET['order_status'])) {
          if($_GET['order_status'] == "Pending") 
            {echo "selected";}
          }?>>Pending</option>
      <option value="COMPLETED" <?php if(isset($_GET['order_status'])) {
          if($_GET['order_status'] == "COMPLETED") 
            {echo "selected";}
          }?>>Paid</option>
    </select>
    <input type="text" class="form-control tanggal" name="mulai" value="<?php if(isset($_GET['mulai'])) {
          echo $_GET['mulai'];     }?>" placeholder="dd-mm-yyyy">
    <span class="input-group-append">
      <span class="btn btn-dark" type="submit" name="sd" value="sd">
       &nbsp; to &nbsp;
      </span>
    </span>
    <input type="text" class="form-control tanggal" name="selesai" value="<?php if(isset($_GET['selesai'])) {
          echo $_GET['selesai'];     }?>" placeholder="dd-mm-yyyy">
    <span class="input-group-append">
      <button class="btn btn-info " type="submit" name="filter" value="Filter">
        <i class="fa fa-print"></i> Filter
      </button>
    </span>
  </div>

</div>
<div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-stripped table-bordered" cellspacing="0" width="100%">
<thead>
    <tr> 
        <th width="5%">Order Id</th>
        <th width="15%">Username</th>
        <th width="15%">Services</th>
        <th width="15%">Product</th>
        <th width="10%">ID SMM</th>
        <th width="15%">Order Date</th>
        <th width="10%">Paid Status</th>
        <th width="10%">Current Qty</th>
        <th width="15%">Email</th>
        <th width="15%">Status</th>
    </tr>
</thead>
<tbody>

  <?php 
  // Looping data user dg foreach
  foreach($pemesanan as $pemesanans) {
    $id_pemesanan = $pemesanans->order_id;
  ?>

  <tr> 
    <td>{{$id_pemesanan}} </td>
    <td>{{$pemesanans->customer_link}} </td>
    <td>{{$pemesanans->services_name}} </td>
    <td>{{$pemesanans->product_name}} </td>
    <td>{{$pemesanans->product_id_smm}} </td>
    <td>{{$pemesanans->order_date}} </td>
    <td>{{$pemesanans->order_status}} </td>
    <td>{{$pemesanans->product_qty}} </td>
    <td>{{$pemesanans->customer_email}} </td>
    <td>{{$pemesanans->response_service}} </td>
  </tr>

  <?php  } //End looping ?>
</tbody>
</table>

</div>
<div class="col-md-12 text-center">
     {{ $pemesanan->appends(request()->query())->links() }}
</div>

</form>


