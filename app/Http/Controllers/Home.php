<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    // Homepage
    public function index()
    {
    	$site 	= DB::table('konfigurasi')->first();
       
        $product = DB::table('t_produk')
            ->where([
                                   'active_status' => '1',
                                   'selected_product' => '1'
                            ]
                        )
            ->orderBy('product_id','ASC')
            ->get();

            $services = DB::table('t_services')
            ->where([
                                   'active_status' => '1',
                            ]
                        )
            ->orderBy('services_name','ASC')
            ->get();

        $faq = DB::table('t_faq')
            ->where('active_status','=','1')
            ->orderBy('faq_id','ASC')
            ->get();

        $pages = DB::table('t_pages')
            ->where('active_status','=','1')
            ->orderBy('id','ASC')
            ->get();


        $data = array(  'title'     => $site->namaweb.' - '.$site->tagline,
                        'deskripsi' => $site->namaweb.' - '.$site->tagline,
                        'keywords'  => $site->namaweb.' - '.$site->tagline,
                        'site'		=> $site,
                        'product'   => $product,
                        'services'   => $services,
                        'faq'   => $faq,
                        'pages'   => $pages,
                        'content'   => 'home/index'
                    );
        return view('layout/wrapper',$data);
    }

    // kontak
    public function addContact(Request $request)
    {
        
        $name = filter_param($request->name);
        $email = filter_param($request->email);
        $subject = filter_param($request->subject);
        $message = filter_param($request->message);

          DB::table('t_contacts')->insert([
            'contact_name'         => $name,
            'contact_email'    => $email,
            'contact_message'   => $message,
            'contact_subject'   => $subject,
            'contact_date'     => date('Y-m-d H:i:s'),
            'read_status'       => 0
        ]);
        
        return 'OK';
    }

    
}