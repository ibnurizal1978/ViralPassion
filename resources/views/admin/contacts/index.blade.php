


<div class="clearfix"><hr></div>
<form action="{{ asset('admin') }}" method="post" accept-charset="utf-8">
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
            <th width="5%">ID</th>
            <th width="15%">Contact Date</th>
            <th width="15%">Contact Name</th>
            <th width="15%">Contact Email</th>
            <th width="45%">Contact Subject</th>
            <th width="10%">Status</th>
            <th width="10%">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1; foreach($produk as $product) { ?>

            <tr class="odd gradeX">
              <td>{{$product->contact_id}}</td>
              <td >{{$product->contact_date}}</td>
              <td >{{$product->contact_name}}</td>
              <td>{{$product->contact_email}}</td>
              <td >{{$product->contact_subject}}</td>
               <td><b>{{$product->read_status == '0' ? 'Unread' : 'Replied'}}</b></td>
                <td>
                    <div class="btn-group">                     
                        <a href="{{ asset('admin/contact/reply/'.Crypt::encrypt($product->contact_id)) }}" class="btn btn-warning btn-sm"><i  class="fa fa-reply-all" aria-hidden="true"></i></a>
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
