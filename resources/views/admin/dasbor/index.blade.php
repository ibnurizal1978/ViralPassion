<div class="alert alert-info">
  Hi <strong>{{ Session()->get('nama') }}</strong>, Welcome back!
</div>
<hr>
<div class="row">
<!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-6">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Order (Total Success Payment)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($Konfirmasi) ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-hourglass fa-2x text-gray-300"></i> -->
                      <i class="fas fa-download fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-6">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">(Success Order SMM Panel)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($suksesOrderSmm) ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-upload fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

             <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-6">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">(Failed Order SMM Panel)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($failedOrderSmm) ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hourglass fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           
</div>
<div class="clearfix"></div>
<hr>
<h4>Top 10 data orders</h4>
<hr>
@include('admin/order/indexDashboard')