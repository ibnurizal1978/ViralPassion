<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pages extends Controller
{

   
    public function index()
    {
    	

		$pages = DB::table('t_pages')
            ->select('*')
            ->orderBy('t_pages.id','ASC')
            ->paginate(20);

		$data = array(  'title'				=> 'Pages',
						'pages'			=> $pages,
                        'content'			=> 'admin/pages/index'
                    );
        
        return view('admin/layout/wrapper',$data);
    }

      

    // Tambah
    public function tambah()
    {
        
        $data = array(  'title'             => 'Add Page',
                        'content'           => 'admin/pages/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id)
    {
        

        $prd = DB::table('t_pages')
            ->select('*')
            ->where('id',filter_param($id))
            ->first();

       

        $data = array(  'title'             => 'Edit Page',
                        'pages'            => $prd, 
                        'content'           => 'admin/pages/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses(Request $request)
    {
        
             

        DB::table('t_pages')->insert([
            'title'    => filter_param($request->title),    
            'slug_title'    => str_slug(filter_param($request->title),"-"),  
            'summary'     => filter_param($request->summary),
            'content'     => $request->content,
            'active_status'     => filter_param($request->active_status),       
            'user_id'                => Session()->get('id_user'),        
            'updated_date'          => date('Y-m-d H:i:s') 
        ]);
        return redirect('admin/pages')->with(['sukses' => 'Success Insert Data']);
    }

    // edit
    public function edit_proses(Request $request)
    {
       
        DB::table('t_pages')->where('id',filter_param($request->id))->update([
            'title'    => filter_param($request->title),    
            'slug_title'    => str_slug(filter_param($request->title),"-"),  
            'summary'     => filter_param($request->summary),
            'content'     => $request->content,
            'active_status'     => filter_param($request->active_status),       
            'user_id'                => Session()->get('id_user'),        
            'updated_date'          => date('Y-m-d H:i:s') 
        ]);
        
        return redirect('admin/pages')->with(['sukses' => 'Success Update Data']);

    }

   
}
