<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use App\Pemesanan_model;
use App\Produk_model;
use PDF;

class Order extends Controller
{
    // Main page
    public function index()
    {
    	
        $pemesanan = DB::table('t_orders')
                    ->join('t_produk', 't_produk.product_id', '=', 't_orders.product_id','LEFT')
                    ->join('t_services', 't_services.services_id', '=', 't_orders.services_id','LEFT')
                    ->join('t_customers', 't_customers.customer_id', '=', 't_orders.customer_id','LEFT')
                    ->select('t_orders.*', 't_services.services_name', 't_produk.product_name','t_customers.customer_name','t_customers.customer_email','t_produk.product_id_smm','t_produk.product_qty','t_customers.customer_link')
                    ->orderBy('t_orders.order_date','DESC')
                    ->paginate(20);

		$data = array(  'title'       => 'Data Order',
						'pemesanan'   => $pemesanan,
                        'content'     => 'admin/order/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

   

    // Main page
    public function filter(Request $request)
    {
        $order_status   = filter_param($request->order_status);
        $mulai          = filter_param($request->mulai);
        $selesai        = filter_param($request->selesai);

        
        if($mulai != "")
        {
            $tgl_mulai          = date('Y-m-d',strtotime($mulai))." 00:00:00";
        }
        if($mulai != "")
        {
            $tgl_selesai        = date('Y-m-d',strtotime($selesai))." 23:59:59";
        }

        if($mulai != "" || $selesai != "")
        {

            if($order_status != 'all')
                 {
                    $pemesanan = DB::table('t_orders')
                            ->join('t_produk', 't_produk.product_id', '=', 't_orders.product_id','LEFT')
                            ->join('t_services', 't_services.services_id', '=', 't_orders.services_id','LEFT')
                            ->join('t_customers', 't_customers.customer_id', '=', 't_orders.customer_id','LEFT')
                            ->whereBetween('t_orders.order_date', [$tgl_mulai, $tgl_selesai])
                            ->where('t_orders.order_status',$order_status)
                            ->select('t_orders.*', 't_services.services_name', 't_produk.product_name','t_customers.customer_name','t_customers.customer_email','t_produk.product_id_smm','t_produk.product_qty','t_customers.customer_link')
                            ->orderBy('t_orders.order_date','DESC')
                            ->paginate(50);
                }else
                {
                        $pemesanan = DB::table('t_orders')
                            ->join('t_produk', 't_produk.product_id', '=', 't_orders.product_id','LEFT')
                            ->join('t_services', 't_services.services_id', '=', 't_orders.services_id','LEFT')
                            ->join('t_customers', 't_customers.customer_id', '=', 't_orders.customer_id','LEFT')
                            ->whereBetween('t_orders.order_date', [$tgl_mulai, $tgl_selesai])
                            ->select('t_orders.*', 't_services.services_name', 't_produk.product_name','t_customers.customer_name','t_customers.customer_email','t_produk.product_id_smm','t_produk.product_qty','t_customers.customer_link')
                            ->orderBy('t_orders.order_date','DESC')
                            ->paginate(50);
                }

        }else
            {

                 if($order_status != 'all')
                 {
                    $pemesanan = DB::table('t_orders')
                            ->join('t_produk', 't_produk.product_id', '=', 't_orders.product_id','LEFT')
                            ->join('t_services', 't_services.services_id', '=', 't_orders.services_id','LEFT')
                            ->join('t_customers', 't_customers.customer_id', '=', 't_orders.customer_id','LEFT')
                            ->where('t_orders.order_status',$order_status)
                            ->select('t_orders.*', 't_services.services_name', 't_produk.product_name','t_customers.customer_name','t_customers.customer_email','t_produk.product_id_smm','t_produk.product_qty','t_customers.customer_link')
                            ->orderBy('t_orders.order_date','DESC')
                            ->paginate(50);
                }else
                {
                        $pemesanan = DB::table('t_orders')
                            ->join('t_produk', 't_produk.product_id', '=', 't_orders.product_id','LEFT')
                            ->join('t_services', 't_services.services_id', '=', 't_orders.services_id','LEFT')
                            ->join('t_customers', 't_customers.customer_id', '=', 't_orders.customer_id','LEFT')
                            ->select('t_orders.*', 't_services.services_name', 't_produk.product_name','t_customers.customer_name','t_customers.customer_email','t_produk.product_id_smm','t_produk.product_qty','t_customers.customer_link')
                            ->orderBy('t_orders.order_date','DESC')
                            ->paginate(50);
                }

            }
        
        $data = array(  'title'       => 'Data Order',
                        'pemesanan'   => $pemesanan,
                        'content'     => 'admin/order/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Cari
    public function cari(Request $request)
    {

        $keywords           = filter_param($request->keywords);
        $pemesanan = DB::table('t_orders')
                    ->join('t_produk', 't_produk.product_id', '=', 't_orders.product_id','LEFT')
                    ->join('t_services', 't_services.services_id', '=', 't_orders.services_id','LEFT')
                    ->join('t_customers', 't_customers.customer_id', '=', 't_orders.customer_id','LEFT')
                    ->where('t_orders.no_invoice', 'LIKE', "%{$keywords}%") 
                    ->orWhere('t_customers.customer_link', 'LIKE', "%{$keywords}%") 
                    ->orWhere('t_produk.product_name', 'LIKE', "%{$keywords}%") 
                    ->orWhere('t_produk.product_id_smm', 'LIKE', "%{$keywords}%") 
                    ->orWhere('t_orders.response_service', 'LIKE', "%{$keywords}%") 
                    ->select('t_orders.*', 't_services.services_name', 't_produk.product_name','t_customers.customer_name','t_customers.customer_email','t_produk.product_id_smm','t_produk.product_qty','t_customers.customer_link')
                    ->orderBy('t_orders.order_date','DESC')
                    ->paginate(50);

       

        $data = array(  'title'             => 'Data Order',
                        'pemesanan'            => $pemesanan,
                        'content'           => 'admin/order/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

 
 
}
