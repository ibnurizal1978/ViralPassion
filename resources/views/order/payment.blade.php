  <main id="main">

    

    <section class="site-content container contact" id="contact">

    	

   
  
   <!-- /title -->
   <div class="column twocol"></div>
   <form method="post" action="{{asset('payment')}}" class="php-email-form_order">
      <div class="column eightcol">
       <!--   <div class="alert alert-danger" style="display: none;">
            <p style="color: #fff;">We are under maintenance, please check back again in 30 minutes. Regards.</p>
         </div> -->
         <h1 style="color: #0c0c0c;padding: 15px 10px;background: #eeeeee;font-weight: lighter !important;text-align: center;border: 1px solid #dfdfdf;margin-bottom: 0px;">Review &amp; Payment</h1>

          @if(strlen($display_error) > 0)
              	<div class="row text-center" style="margin-bottom: 10px;border-bottom: 2px dashed #eee;overflow: hidden;padding-bottom: 20px;display:block"><br><br>
			          <h2><span style="color: #28425f;text-transform:capitalize;"> <span id="sp_sp_qunatity">  {{$display_error}}</span></span></h2><br/>
			          <a href="{{asset('order/'.$id)}}">Back To Products</a>
			       </div>
              @else


         	<div class="details_form" style="min-height: 300px;border: 1px solid #dfdfdf;border-top-width: 0px;padding: 20px 25px;box-shadow: 2px 10px 5px #aaaaaa;">
            <!-- <div class="alert alert-danger" style="display:none;" id="error_message_div_div">
               <h4>Oops! Errors:</h4>
               <ul>
                  <li><span id="sp_error_message_show_div"></span></li>
               </ul>
            </div> -->
            <div class="row text-center" style="margin-bottom: 10px;border-bottom: 2px dashed #eee;overflow: hidden;padding-bottom: 20px;display:block">
               <h2><span style="color: #28425f;text-transform:capitalize;"> <span id="sp_sp_qunatity">{{number_format($product->product_qty,0,',','.')}}</span> 
                  <span id="sp_sp_typee">{{$product->services_name}} {{$product->nama_tipe}}</span> </span> Package
               </h2>
               <div style="width:100%; font-size: 15px;">
                  <img src="{{$img}}" class="img-rounded" style="width: 80px;height: 80px;border: 5px solid #eee;border-radius: 50%;">
               </div>
               @if($count != "")
                <p style="width:100%;">({{$product->services_name}} Current {{$product->nama_tipe}} {{$count}})</p>
               @endif
            </div>
            <div class="row text-center" style="display:block">
              <!--  <div class="text-center" style="padding: 15px 0px;border-bottom: 2px dashed #eee;margin-bottom: 15px;">
                  <div class="coupon">
                     <span id="sp_coupon_show"> </span>
                     <div class="coupon-code" style="display: none;">
                        <div class="form-group">
                           <input type="text" class="form-control text-center" name="code" id="coupon_code" placeholder="Enter Coupon Code" style="min-width: 100%;text-transform: uppercase;margin-bottom: 5px;">
                           <button type="button" class="btn" style="padding: 7px 15px;margin-top: 10px; width:100%" onClick="coupon_apl();">Apply</button>
                        </div>
                     </div>
                     <a href="javascript: void();" onclick="$(this).hide();$('.coupon-code').show();" style="font-size: 1.3em;" id="show_coupon_code_ahref">Have a coupon code?</a>
                  </div>
               </div> -->
               <span style="font-size: 1.6em;font-weight: 900;">Grand Total: {{$site->currency}}<span id="grand_amount">{{$product->product_price}}</span> </span>
               <div class="row text-center" style="padding: 15px 10px;margin-bottom: 10px;overflow: hidden;display:block">
               </div>
              <div class="text-center"><button type="submit">Proceed to Payment</button></div>
            </div>
         </div>
         @endif
      </div>
   </form>
</section>

  </main><!-- End #main -->