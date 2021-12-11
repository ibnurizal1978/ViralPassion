<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Product extends Controller
{

    // Main page
    public function index()
    {
    	

		$produk = DB::table('t_produk')
            ->join('t_services', 't_services.services_id', '=', 't_produk.service_id')
            ->join('t_tipe_produk', 't_tipe_produk.tipe_id', '=', 't_produk.tipe_id')
            ->select('*')
            ->orderBy('t_produk.product_id','DESC')
            ->paginate(20);

		$data = array(  'title'				=> 'Products',
						'produk'			=> $produk,
                        'content'			=> 'admin/product/index'
                    );
        
        return view('admin/layout/wrapper',$data);
    }

     
 
     public function cari(Request $request)
    {
        

        $keywords           = filter_param($request->keywords);
        $produk = DB::table('t_produk')
            ->join('t_services', 't_services.services_id', '=', 't_produk.service_id')
            ->join('t_tipe_produk', 't_tipe_produk.tipe_id', '=', 't_produk.tipe_id')
            ->where('t_produk.product_name', 'LIKE', "%{$keywords}%") 
            ->orWhere('t_services.services_name', 'LIKE', "%{$keywords}%") 
            ->orWhere('t_produk.product_id_smm', 'LIKE', "%{$keywords}%")
            ->select('*')
            ->paginate(20);

        $data = array(  'title'             => 'Products',
                        'produk'            => $produk,
                        'content'           => 'admin/product/index'
                    );
        return view('admin/layout/wrapper',$data);

    }

    // Tambah
    public function tambah()
    {
        

         $services = DB::table('t_services')
            ->select('*')
            ->where('active_status','1')
            ->get();

        $type = DB::table('t_tipe_produk')
            ->select('*')
            ->where('active_status','1')
            ->get();
        
        $data = array(  'title'             => 'Add Product',
                        'services'            => $services, 
                        'type'            => $type, 
                        'content'           => 'admin/product/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($product_id)
    {
        

        $prd = DB::table('t_produk')
            ->select('*')
            ->where('product_id',filter_param($product_id))
            ->first();

        $services = DB::table('t_services')
            ->select('*')
            ->where('active_status','1')
            ->get();

        $type = DB::table('t_tipe_produk')
            ->select('*')
            ->where('active_status','1')
            ->get();

        $data = array(  'title'             => 'Edit Product',
                        'product'            => $prd, 
                        'services'            => $services, 
                        'type'            => $type, 
                        'content'           => 'admin/product/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses(Request $request)
    {
        
             

        DB::table('t_produk')->insert([
            'service_id'    => filter_param($request->services_id),    
            'tipe_id'    => filter_param($request->tipe_id),  
            'product_name'     => filter_param($request->product_name),
            'active_status'     => filter_param($request->active_status),            
            'product_description'    => $request->product_description,   
            'product_price'     => filter_param($request->product_price),
            'product_qty'    => filter_param($request->product_qty), 
            'product_id_smm'    => filter_param($request->product_id_smm),   
            'active_status'     => filter_param($request->active_status),
            'selected_product'     => filter_param($request->selected_product),
            'featured_product'     => filter_param($request->featured_product),
           'user_id'                => Session()->get('id_user'),        
            'inserted_date'          => date('Y-m-d H:i:s') 
        ]);
        return redirect('admin/product')->with(['sukses' => 'Success Insert Data']);
    }

    // edit
    public function edit_proses(Request $request)
    {
       
        

        DB::table('t_produk')->where('product_id',filter_param($request->product_id))->update([
            'service_id'    => filter_param($request->services_id),     
            'tipe_id'    => filter_param($request->tipe_id),  
            'product_name'     => filter_param($request->product_name),
            'active_status'     => filter_param($request->active_status),            
            'product_description'    => $request->product_description,   
            'product_price'     => filter_param($request->product_price),
            'product_qty'    => filter_param($request->product_qty), 
            'product_id_smm'    => filter_param($request->product_id_smm),
            'selected_product'     => filter_param($request->selected_product),
            'featured_product'     => filter_param($request->featured_product),   
            'active_status'     => filter_param($request->active_status),
        ]);
        
        return redirect('admin/product')->with(['sukses' => 'Success Update Data']);

    }

   
}
