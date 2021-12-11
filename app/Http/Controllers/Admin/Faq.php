<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Faq extends Controller
{
    // Main page
    public function index()
    {
    	

		$faq = DB::table('t_faq')->paginate(10);

		$data = array(  'title'				=> 'Faq',
						'faq'			=> $faq,
                        'content'			=> 'admin/faq/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

     
 
 

    // Tambah
    public function tambah()
    {
        
        
        $data = array(  'title'             => 'Add Faq',
                        'content'           => 'admin/faq/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($faq_id)
    {
        

        $faq = DB::table('t_faq')
            ->select('*')
            ->where('faq_id',filter_param($faq_id))
            ->first();

        $data = array(  'title'             => 'Edit Faq',
                        'faq'            => $faq, 
                        'content'           => 'admin/faq/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses(Request $request)
    {
        
        

       

        DB::table('t_faq')->insert([
           'user_id'                => Session()->get('id_user'),
            'faq_question'    => filter_param($request->faq_question),   
            'faq_answer'    => filter_param($request->faq_answer), 
            'active_status'     => filter_param($request->active_status)
        ]);
        return redirect('admin/faq')->with(['sukses' => 'Success Insert Faq']);
    }

    // edit
    public function edit_proses(Request $request)
    {
       
       
        

        DB::table('t_faq')->where('faq_id',filter_param($request->faq_id))->update([
            'faq_question'    => filter_param($request->faq_question),   
            'faq_answer'    => filter_param($request->faq_answer), 
            'active_status'     => filter_param($request->active_status)
        ]);
        
        return redirect('admin/faq')->with(['sukses' => 'Success Update Faq']);

    }

   
}
