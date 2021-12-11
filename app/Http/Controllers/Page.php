<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Page extends Controller
{
    // Main page
    public function index($slug)
    {
       	$pages 	= DB::table('t_pages')->where(['slug_title' => filter_param($slug)])->first();
        $site   = DB::table('konfigurasi')->first();

		$data = array(  'site'		=> $site,
                        'title'     => $site->namaweb.' - '.$site->tagline,
                        'deskripsi' => $site->namaweb.' - '.$site->tagline,
                        'keywords'  => $site->namaweb.' - '.$site->tagline,
                        'page'      => $pages,
                        'content'	=> 'page/index'
                    );
        return view('layout/wrapper',$data);
    }

   

}
