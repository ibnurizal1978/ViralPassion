<div class="row">
 

</div>

<form action="{{ asset('admin/pemesanan/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">

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

</form>


