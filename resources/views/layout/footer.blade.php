<?php
use Illuminate\Support\Facades\DB;
use App\Nav_model;
$site       = DB::table('konfigurasi')->first();

$myproduk             = new Nav_model();
$nav_services  = $myproduk->nav_services();
?>

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3><a href="{{asset('/')}}"><img src="{{ asset('public/upload/image/logo.png') }}" width="180" /></a></h3>
            <br/>
            <p>Viral Passion DotNet is a social media agency that focuses on developing our clients' social media accounts by providing high engagement value for them.</p>
          </div>

          <div class="col-lg-4 col-md-6 footer-links text-center">
            <br/>
            <img src="{{ asset('public/upload/image/paypal.png') }}" width="60" />&nbsp;&nbsp;&nbsp;
            <img src="{{ asset('public/upload/image/visa.png') }}" width="90" />&nbsp;&nbsp;&nbsp;
            <img src="{{ asset('public/upload/image/ssl.png') }}" width="90" />
            <br/><br/>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Company</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{asset('/#home')}}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{asset('/#about')}}">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{asset('page/terms-of-service')}}">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{asset('page/privacy-policy')}}">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              @foreach ($nav_services as $nav)
                  <li><i class="bx bx-chevron-right"></i> <a href="<?php echo asset("/#services"); ?>">{{$nav->services_name}} Media Services</a></li>
              @endforeach

            </ul>
          </div>

          <!-- <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div> -->

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright @<?php echo date('Y') ?> <strong><span>{{$site->namaweb}}</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/resi-free-bootstrap-html-template/ -->
          <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
 

  <!-- Vendor JS Files -->
  <script src="{{ asset('public/template/assets_new/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('public/template/assets_new/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('public/template/assets_new/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('public/template/assets_new/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('public/template/assets_new/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('public/template/assets_new/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('public/template/assets_new/vendor/jquery/jquery.min.js') }}"></script>
  <?php if(env('PAYPAL_MODE') == "sandbox") {?>
  <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}&currency={{$site->currency_name}}"></script>
  <?php }else {?>
  <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_LIVE_CLIENT_ID')}}&currency={{$site->currency_name}}"></script>

  <?php }?>
  <!-- Template Main JS File -->
  <script src="{{ asset('public/template/assets_new/js/main.js') }}"></script>

</body>
</html>

@if(isset($session_id))
<script type="text/javascript">
    paypal.Buttons({
      style: {
                color:  'blue',
                shape:  'pill',
                label:  'pay'
            },
     createOrder: function(data, actions) {

       var token = $('_token').val();

                return fetch('{{asset("payment/create")}}', {
                    method: 'POST',
                    headers: {
                          'content-type': 'application/json',
                          "Accept": "application/json, text-plain, */*",
                          "X-Requested-With": "XMLHttpRequest",
                          'X-CSRF-TOKEN': "{{ csrf_token() }}"
                      },
                    body:JSON.stringify({
                        'session_id': "{{$session_id}}",
                        'product_id' : "{{$product_id}}",
                        'payment_channel' : 'paypal',
                        '_token' :" {{csrf_token()}}"
                    })
                }).then(function(res) {
                  console.log(res);
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            }
    ,onApprove: function(data, actions) {

       let token = $('_token').val();

      return fetch('{{asset("payment/capture")}}' , {
                    method: 'POST',
                    headers: {
                          'content-type': 'application/json',
                          "Accept": "application/json, text-plain, */*",
                          "X-Requested-With": "XMLHttpRequest",
                          'X-CSRF-TOKEN': "{{ csrf_token() }}"
                      },
                    body :JSON.stringify({
                        orderId : data.orderID,
                        session_id: "{{$session_id}}",
                        product_id : "{{$product_id}}",
                        _token :" {{csrf_token()}}"
                    })
                }).then(status)
                  .then(function(response){
                      // redirect to the completed page if paid
                      window.location.href = '{{asset("payment/success")}}';
                  });
    }
  })
  .render('#paypal-button-container');
</script>
@endif

<script type="text/javascript">

$(document).ready(function(){
    $('.check').click(function() {
        $('.check').not(this).prop('checked', false);
    });
});



function img_load_more()
{
  $(document).ready(function(e) {
    var c2=$(".order_media").serialize();
    var c1 = $('#max_media_selection').val();
    var c3 = $('#next_page_for_img_load').val();

   
    
    $("#load_more").val("LOADING...");
    $("#load_more").prop('disabled', true);
    $.ajax({
      type:"POST",
      data:c2,
      url:"{{asset('media-load-more')}}",
      success: function(html){
        // console.log(html);
        var max = parseInt(c1)+parseInt(c3);
        $('#next_page_for_img_load').val(max);
        $("#load_more").prop('disabled', false);
        $("#load_more").val("Load More");
        $("#sp_show_image_load_more").append(html);
      }
      })
    
    });
}

 
</script>