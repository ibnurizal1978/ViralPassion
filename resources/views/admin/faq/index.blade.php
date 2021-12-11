
<div class="row">

  <div class="col-md-6">
    <form action="{{ asset('admin/services/cari') }}" method="get" accept-charset="utf-8">
    <br>
    <div class="input-group">                  
      <span class="input-group-btn btn-flat">
        <a href="{{ asset('admin/faq/tambah') }}" class="btn btn-success">
        <i class="fa fa-plus"></i> Add</a>
      </span>
    </div>
    </form>
  </div>
  <div class="col-md-6 text-left">
   
  </div>
</div>

<div class="clearfix"><hr></div>
<form action="{{ asset('admin/faq/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<div class="row">


    </div>
    <div class="clearfix"><hr></div>
    <div class="table-responsive mailbox-messages">
      <table id="example1" class="display  table-striped table table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th width="8%">Question</th>
            <th width="20%">Active Status</th>
            <th width="20%">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1; foreach($faq as $data) { ?>

            <tr class="odd gradeX">
              <td width="10%">{{$data->faq_id}}</td>
              <td width="50%">{{$data->faq_question}}</td>
              <td width="30%">{{$data->active_status == '1' ? 'Active' : 'Deactive'}}</td>

                  <td>
                    <div class="btn-group">
                     
                        <a href="{{ asset('admin/faq/edit/'.$data->faq_id) }}" 
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
              <div class="pull-right">{{$faq->links()}}</div>
