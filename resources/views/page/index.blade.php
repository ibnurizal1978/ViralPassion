<main id="main">

    <!-- ======= Breadcrumbs ======= --><br>
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{$page->title}}</h2>
          <ol>
            <li><a href="{{asset('/#hero')}}">Home</a></li>
            <li>{{$page->title}}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        {!!html_entity_decode($page->content)!!}
      </div>
    </section>

  </main><!-- End #main -->