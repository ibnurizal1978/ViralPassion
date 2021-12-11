
<div class="row">

  <div class="col-md-6">
    <form action="{{ asset('admin/product/cari') }}" method="get" accept-charset="utf-8">
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="keywords" value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>" placeholder="Keywords..." required>
      <span class="input-group-append">
            <button type="submit" name="cari" class="btn btn-info" value="cari">Search</button>
            <a href="{{ asset('admin/product') }}" class="btn btn-info ">
               Reset
            </a>
            <a href="{{ asset('admin/product/tambah') }}" class="btn btn-success ">
              <i class="fa fa-plus"></i> Add Product
            </a>
      </span>
    </div>
    </form>
</div>
  <div class="col-md-6 text-left">
   
  </div>
</div>

<div class="clearfix"><hr></div>
<form action="{{ asset('admin/product/filter') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<div class="row">


  <div class="col-md-8">
    <div class="btn-group">
      
 

        </div>
      </div>
    </div>
    <div class="clearfix"><hr></div>
    <div class="table-responsive mailbox-messages">
      <table id="example1" class="display  table-striped table table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th width="15%">Services Name</th>
            <th width="15%">Product Type</th>
            <th width="15%">Product Name</th>
            <th width="10%">ID SMM</th>
            <th width="10%">Product Price</th>
            <th width="10%">Product Qty</th>
            <th width="10%">Active Status</th>
            <th width="10%">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1; foreach($produk as $prd) { ?>

            <tr class="odd gradeX">
              <td >{{$prd->product_id}}</td>
              <td  >{{$prd->services_name}}</td>
              <td  >{{$prd->nama_tipe}}</td>
              <td >{{$prd->product_name}}</td>
              <td >{{$prd->product_id_smm}}</td>
              <td >{{$prd->product_price}}</td>
              <td >{{$prd->product_qty}}</td>
              <td >{{$prd->active_status == '1' ? 'Active' : 'Deactive'}}</td>

                  <td>
                    <div class="btn-group">
                     
                        <a href="{{ asset('admin/product/edit/'.$prd->product_id) }}" 
                          class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
 
                        </div>
                        
                      </td>
                    </tr>

                    <?php $i++; } ?>

                  </tbody>
                </table>
              </div>

              </form>

              <div class="clearfix"><hr></div>
              <div class="pull-right">{{$produk->links()}}</div>
