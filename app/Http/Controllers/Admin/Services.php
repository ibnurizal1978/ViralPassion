<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services_model;
use Image;

class Services extends Controller
{
    // Main page
    public function index()
    {
    	

		$produk = DB::table('t_services')->get();

		$data = array(  'title'				=> 'Services',
						'produk'			=> $produk,
                        'content'			=> 'admin/services/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

     
 
 

    // Tambah
    public function tambah()
    {
        
        
        $data = array(  'title'             => 'Add New Services',
                        'content'           => 'admin/services/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($services_id)
    {
        

        $services = DB::table('t_services')
            ->select('*')
            ->where('services_id',filter_param($services_id))
            ->first();

        $data = array(  'title'             => 'Edit Service',
                        'services'            => $services, 
                        'content'           => 'admin/services/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses(Request $request)
    {
        
        request()->validate([
                            'service_name'   => 'required'
                            ]);

         // UPLOAD START
            $image                  = $request->file('icon');
            $filenamewithextension  = $request->file('icon')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = str_slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = public_path('upload/image/');
            $img = Image::make($image->getRealPath(),array(
                'width'     => 100,
                'height'    => 100,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            // $destinationPath = public_path('upload/image/');
            // $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD

        DB::table('t_services')->insert([
           'user_id'                => Session()->get('id_user'),
            'services_name'    => filter_param($request->service_name),   
            'icon'     =>  $input['nama_file'],  
            'active_status'     => filter_param($request->active_status), 
            'description'     => $request->description,        
            'inserted_date'          => date('Y-m-d H:i:s') 
        ]);
        return redirect('admin/services')->with(['sukses' => 'Success Insert Services']);
    }

    // edit
    public function edit_proses(Request $request)
    {
       
        request()->validate([
                            'service_name'   => 'required'
                            ]);

            $image                  = $request->file('icon');
           if(!empty($image))
           {
                // UPLOAD START
                $filenamewithextension  = $request->file('icon')->getClientOriginalName();
                $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $input['nama_file']     = str_slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath        = public_path('upload/image/');
                $img = Image::make($image->getRealPath(),array(
                    'width'     => 100,
                    'height'    => 100,
                    'grayscale' => false
                ));
                $img->save($destinationPath.'/'.$input['nama_file']);
                
                DB::table('t_services')->where('services_id',filter_param($request->services_id))->update([ 
                        'services_name'  => filter_param($request->service_name),    
                        'icon'           =>  $input['nama_file'],  
                        'description'  => $request->description,  
                        'active_status'  => filter_param($request->active_status)
                    ]);

           }else
           {
                DB::table('t_services')->where('services_id',filter_param($request->services_id))->update([ 
                        'services_name'  => filter_param($request->service_name), 
                        'description'  => filter_param($request->description),  
                        'active_status'  => filter_param($request->active_status)
                    ]);

           }
        

        
        
        return redirect('admin/services')->with(['sukses' => 'Success Update Services']);

    }

   
}
