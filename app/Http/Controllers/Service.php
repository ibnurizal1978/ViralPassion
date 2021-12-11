<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Service extends Controller
{
    // Main page
    public function index($slug)
    {
    	$slug_exp = explode('-', filter_param($slug));

        $site   = DB::table('konfigurasi')->first();
       	// $pages 	= DB::table('t_pages')->where('slug_title',$slug)->first();
          $faq = DB::table('t_faq')
            ->where('active_status','=','1')
            ->orderBy('faq_id','ASC')
            ->get();

         $services = DB::table('t_services')
            ->where('t_services.services_name',$slug_exp[0])
            ->first();

          $products = DB::table('t_produk')
            ->join('t_services','t_services.services_id','t_produk.service_id')
            ->join('t_tipe_produk','t_tipe_produk.tipe_id','t_produk.tipe_id')
            ->where(['t_services.services_name' =>$slug_exp[0],
            			't_tipe_produk.nama_tipe' => $slug_exp[1],
                       't_produk.active_status' => '1' ])
            ->select('*')
            ->get();



		$data = array(  'site'		=> $site,
                        'title'     => $site->namaweb.' - '.$site->tagline,
                        'deskripsi' => $site->namaweb.' - '.$site->tagline,
                        'keywords'  => $site->namaweb.' - '.$site->tagline,
                        'services'   => $services,
                        'product'   => $products,
                        'faq'   => $faq,
                        'content'	=> 'service/index'
                    );
        return view('layout/wrapper',$data);
    }

   

}
