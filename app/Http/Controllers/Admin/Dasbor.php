<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Konfigurasi_model;
use Image;
use App\Pemesanan_model;
use App\Produk_model;
use PDF;

class Dasbor extends Controller
{


    // Index
    public function index()
    {
        
    	$mysite = new Konfigurasi_model();
		$site 	= $mysite->listing(); 
      
       $pemesanan = DB::table('t_orders')
                    ->join('t_produk', 't_produk.product_id', '=', 't_orders.product_id','LEFT')
                    ->join('t_services', 't_services.services_id', '=', 't_orders.services_id','LEFT')
                    ->join('t_customers', 't_customers.customer_id', '=', 't_orders.customer_id','LEFT')
                    ->select('t_orders.*', 't_services.services_name', 't_produk.product_name','t_customers.customer_name','t_customers.customer_email','t_produk.product_id_smm','t_produk.product_qty','t_customers.customer_link')
                    ->orderBy('t_orders.order_date','DESC')
                    ->limit(10)
                    ->get();

        $suksesOrderSmm   = DB::table('t_orders')->where('response_service','SUCCESS')->count('order_amount');
        $failedOrderSmm   = DB::table('t_orders')->where('response_service', '!=' ,'SUCCESS')->where('order_status','COMPLETED')->count('order_amount');
        $Konfirmasi   = DB::table('t_orders')->where('order_status','COMPLETED')->count('order_amount');

		$data = array(  'title'     => $site->namaweb.' - '.$site->tagline,
                        'pemesanan' => $pemesanan,
                        'Konfirmasi'=> $Konfirmasi,
                        'suksesOrderSmm'=> $suksesOrderSmm,
                        'failedOrderSmm'=> $failedOrderSmm,
                        'content'   => 'admin/dasbor/index'
                    );
        return view('admin/layout/wrapper',$data);
    }
}
