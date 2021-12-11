
<div class="row">

  <div class="col-md-6">
    <form action="{{ asset('admin/services/cari') }}" method="get" accept-charset="utf-8">
    <br>
    <div class="input-group">                  
      <span class="input-group-btn btn-flat">
        <a href="{{ asset('admin/services/tambah') }}" class="btn btn-success">
        <i class="fa fa-plus"></i> Add</a>
      </span>
    </div>
    </form>
  </div>
  <div class="col-md-6 text-left">
   
  </div>
</div>

<div class="clearfix"><hr></div>
<form action="{{ asset('admin/services/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<div class="row">


  <div class="col-md-8">
    <div class="btn-group">
      

         <?php if(isset($pagin)) { echo $pagin; } ?>

        </div>
      </div>
    </div>
    <div class="clearfix"><hr></div>
    <div class="table-responsive mailbox-messages">
      <table id="example1" class="display  table-striped table table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th width="5%">ID</th>
            <th width="8%">Services Name</th>
            <th width="20%">Active Status</th>
            <th width="20%">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1; foreach($produk as $produk) { ?>

            <tr class="odd gradeX">
              <td width="10%">{{$produk->services_id}}</td>
              <td width="50%">{{$produk->services_name}}</td>
              <td width="30%">{{$produk->active_status == '1' ? 'Active' : 'Deactive'}}</td>

                  <td>
                    <div class="btn-group">
                     
                        <a href="{{ asset('admin/services/edit/'.$produk->services_id) }}" 
                          class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

                          <!-- <a href="{{ asset('admin/services/delete/'.$produk->services_id) }}" class="btn btn-danger btn-sm delete-link"><i class="fa fa-trash"></i></a> -->
                        </div>
                        
                      </td>
                    </tr>

                    <?php $i++; } ?>

                  </tbody>
                </table>
              </div>

              </form>

              <div class="clearfix"><hr></div>
              <div class="pull-right"><?php if(isset($pagin)) { echo $pagin; } ?></div>
