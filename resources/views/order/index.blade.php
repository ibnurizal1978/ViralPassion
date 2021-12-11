  <main id="main">

    

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
            <p>&nbsp;</p><p>&nbsp;</p>
          <h2>Let's Start</h2>
          <p>Input your account name or URL to continue. We never ask your password.</p>
        </div>


        <div class="row">

          <div class="col-lg-2"></div>   


          <div class="col-lg-8 mt-4 mt-lg-0">

             
            <form action="{{asset($action)}}" method="post" class="php-email-form_order">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12 form-group">
                  <input type="hidden" name="product_id" value="{{$id}}">
                  <input type="text" name="username" class="form-control" id="name" placeholder="{{$placeholder}}" required>

                </div>
              </div>
              <div class="form-group mt-3">
                <div class="col-md-12 form-group">
                  <input type="text" name="email_Address" class="form-control" id="name" placeholder="Your email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <div  class="form-control" readonly>
                <b>Your choice: {{$product->product_name}} for {{$product->services_name}}</b><br/>
                Investment price: {{$site->currency}}{{$product->product_price}}<br/><br/>
                <?php echo $product->product_description; ?>
                </div>
              </div>
              <div class="my-3">
                Note: Delivery of your order will start automatically after successful payment. A order confirmation email will be sent with order number and details.
              </div>

              <div class="text-center"><button type="submit">Continue</button></div>
            </form>
            
          </div>

          <div class="col-lg-2"></div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->