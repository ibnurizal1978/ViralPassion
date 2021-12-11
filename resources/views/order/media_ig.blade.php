<main id="main">
    <section class="site-content container contact" id="contact">

       @if(count($dataScrap) < 1)
           <div class="row text-center" style="margin-bottom: 10px;border-bottom: 2px dashed #eee;overflow: hidden;padding-bottom: 20px;display:block"><br><br>
                   <h2><span style="color: #28425f;text-transform:capitalize;"> <span id="sp_sp_qunatity"> Invalid Username</span></span></h2><br/>
                   <a href="{{asset('order/'.$product_id)}}">Back To Products</a>
                </div>
      @else
       
      <!-- /title --> 
      <div class="column twocol">&nbsp;</div>
      <form method="post" action="{{asset('checkout')}}" class="php-email-form_order order_media" enctype="multipart/form-data">
           {{ csrf_field() }}
         
         <h1 style="color: #0c0c0c;padding: 15px 10px;background: #eeeeee;font-weight: lighter !important;text-align: center;border: 1px solid #dfdfdf;margin-bottom: 0px;">Select Media for Order</h1>
         <div class="details_form" style="min-height: 300px;border: 1px solid #dfdfdf;border-top-width: 0px;padding: 20px 25px;box-shadow: 2px 10px 5px #aaaaaa;">
            <div class="alert alert-danger" style="display:none;" id="error_message_div_div">
               <h4>Oops! Errors:</h4>
               <ul>
                  <li><span id="sp_error_message_show_div"></span></li>
               </ul>
            </div>
            <input type="hidden" name="product_id" value="{{$product_id}}">
            <input type="hidden" name="username" value="{{$username}}">
            <input type="hidden" name="email_Address" value="{{$email}}">
            <input type="hidden" id="max_media_selection" name="max_media_selection" value="8">
            <div class="row text-center" style="margin-bottom: 10px;border-bottom: 2px dashed #eee;overflow: hidden;padding-bottom: 20px;padding-left: 6px;">
               <div class="text-center" id="sp_show_image_load_more">
                  @foreach($dataScrap as $data)
	                  <div class="img_box" style=" width: 125px;height: 125px;float: left; margin-bottom: 50px;">
	                     <label for="img_' + loop_counter + '" class="img_checkbox_holder text-center">	                       
	                        <div class="set_images" style="margin-top:0px;" id="img">
	                           <img src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents($data['original'])); ?>" style="height:130px; width:120px;border: 1px solid #bbb;">
	                           <input type="checkbox" class="check" style="width:20px;" name="chk_box[]" value="{{$data['link']}}" id="{{$data['link']}}">
	                        </div>
	                     </label>
	                  </div>
                  @endforeach
               </div>
            </div>
            <div class="row text-center">
            	 <span ></span> 
                  <input type="hidden" name="next_page_for_img_load" id="next_page_for_img_load" value="8">     
                  <div style="float: left; width: 100%;">
                     <input type="button" value="Load More" style="width: 108px; height: 43px;font-size: 13px;"
                        onClick="img_load_more();" id="load_more">
                  </div>
                  <div class="down_img_option" style="visibility:hidden"> 
                     <span id="sp_sp_show_id" style="text-transform: capitalize;">0</span> Selected  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                     <span id="sp_sp_quantityy">250</span>
                     <span style="text-transform: capitalize;">likes Per Post </span>
                  </div>
            </div>
            <div class="row text-center">
              <div class="text-center"><button type="submit">Continue</button></div>
            </div>
         </div>
      </form>
      <div class="column twocol"></div>

      @endif
   </section>
</main>
<!-- End #main -->
