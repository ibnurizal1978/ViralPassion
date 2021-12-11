<?php
use Illuminate\Support\Facades\DB;
use App\Nav_model;
$site                 = DB::table('konfigurasi')->first();
// Produk
$myproduk             = new Nav_model();
$nav_services  = $myproduk->nav_services();
$nav_tipe  = $myproduk->nav_tipe();

?>


  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="{{asset('/')}}"><img src="{{ asset('public/upload/image/logo.png') }}" /></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{asset('/#hero')}}">Home</a></li>
          @foreach ($nav_services as $nav)
              <li class="dropdown"><a href="#"><span>{{$nav->services_name}}</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                   @foreach ($nav_tipe as $tipe)
                   @if ($nav->services_id == 2 && $tipe->tipe_id == 1)
                      @continue
                  @elseif ($nav->services_id != 2 && $tipe->tipe_id == 4)
                      @continue
                  @endif
                    <li><a href="<?php echo asset("service/".strtolower($nav->services_name)."-".strtolower($tipe->nama_tipe)); ?>">{{$nav->services_name}} {{$tipe->nama_tipe}}</a></li>
                  @endforeach
                </ul>
              </li>
          @endforeach
          <li><a class="nav-link scrollto" href="{{asset('/#why-us')}}">Why Us?</a></li>
          <li><a class="nav-link scrollto" href="{{asset('/#contact')}}">Contact</a></li>
          <!-- <li><a class="getstarted scrollto" href="#about">Get Started</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->