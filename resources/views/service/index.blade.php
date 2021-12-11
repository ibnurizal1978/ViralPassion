  
  <main id="main">
    <h1>&nbsp;</h1>

   

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title">
          <h2>{{$services->services_name}} Services</h2>
          <p>{{$services->description}}</p>
        </div>

        <div class="row no-gutters">
          @if(count($product) > 0)
            @foreach ($product as $prd)
               <div class="col-lg-4 box <?php if($prd->featured_product == '1') {echo 'featured'; } ?> ">
                  <h3>{{$prd->product_name}}</h3>
                  <h4>{{$site->currency}}{{$prd->product_price}}<span></span></h4>
                  <span style="line-height: 2em; text-align:left;"><?php echo $prd->product_description; ?></a>
                  <a href="{{asset('order/'.Crypt::encrypt($prd->product_id))}}" class="btn-buy">Get Started</a>
                </div>
            @endforeach
          @elseif(count($product) < 1)
            <div class="col-lg-12 box ">
                  <h3>Product Empty</h3>
            </div>
          @endif
          

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
   @if(count($faq) > 0)

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>

        <ul class="faq-list">
           @foreach ($faq as $fq)
             <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq{{$fq->faq_id}}">{{$fq->faq_question}} <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq{{$fq->faq_id}}" class="collapse" data-bs-parent=".faq-list">
              <p>
                {{$fq->faq_answer}}
              </p>
            </div>
          </li>
          @endforeach        
        </ul>

      </div>
    </section><!-- End Frequently Asked Questions Section -->
    @endif
    <!-- End Frequently Asked Questions Section -->

  </main><!-- End #main -->