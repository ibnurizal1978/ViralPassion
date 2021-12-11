<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\Konfigurasi_model;

class Konfigurasi extends Controller
{
    // Main page
    public function index()
    {
    	
    	$mykonfigurasi 	= new Konfigurasi_model();
		$site 			= $mykonfigurasi->listing();

		$data = array(  'title'        => 'Config Website',
						'site'         => $site,
                        'content'      => 'admin/konfigurasi/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // logo
    public function logo()
    {
        
        $mykonfigurasi  = new Konfigurasi_model();
        $site           = $mykonfigurasi->listing();

        $data = array(  'title'        => 'Update Logo',
                        'site'         => $site,
                        'content'      => 'admin/konfigurasi/logo'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // gambar
    public function gambar()
    {
        
        $mykonfigurasi  = new Konfigurasi_model();
        $site           = $mykonfigurasi->listing();

        $data = array(  'title'        => 'Update Gambar Banner',
                        'site'         => $site,
                        'content'      => 'admin/konfigurasi/gambar'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // icon
    public function icon()
    {
        
        $mykonfigurasi  = new Konfigurasi_model();
        $site           = $mykonfigurasi->listing();

        $data = array(  'title'        => 'Update Icon',
                        'site'         => $site,
                        'content'      => 'admin/konfigurasi/icon'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // email
    public function email()
    {
        
        $mykonfigurasi  = new Konfigurasi_model();
        $site           = $mykonfigurasi->listing();

        $data = array(  'title'        => 'Update Setting Email',
                        'site'         => $site,
                        'content'      => 'admin/konfigurasi/email'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // pembayaran
    public function pembayaran()
    {
        
        $mykonfigurasi  = new Konfigurasi_model();
        $site           = $mykonfigurasi->listing();

        $data = array(  'title'        => 'Update Panduan Pembayaran',
                        'site'         => $site,
                        'content'      => 'admin/konfigurasi/pembayaran'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses
    public function proses(Request $request)
    {
        
        request()->validate([
                            'namaweb'          => 'required'
                            ]);
       DB::table('konfigurasi')->where('id_konfigurasi',filter_param($request->id_konfigurasi))->update([
            'namaweb'           => filter_param($request->namaweb),
            'nama_singkat'      => filter_param($request->nama_singkat),
            'singkatan'         => filter_param($request->singkatan),
            'tagline'           => filter_param($request->tagline),
            'tagline2'          => filter_param($request->tagline2),
            'tentang'           => filter_param($request->tentang),
            'website'           => filter_param($request->website),
            'email'             => filter_param($request->email),
            'email_cadangan'    => filter_param($request->email_cadangan),
            'alamat'            => filter_param($request->alamat),
            'telepon'           => filter_param($request->telepon),
            'hp'                => filter_param($request->hp),
            'fax'               => filter_param($request->fax),
            'deskripsi'         => filter_param($request->deskripsi),
            'keywords'          => filter_param($request->keywords),
            'metatext'          => filter_param($request->metatext),
            'facebook'          => filter_param($request->facebook),
            'twitter'           => filter_param($request->twitter),
            'instagram'         => filter_param($request->instagram),
            'nama_facebook'     => filter_param($request->nama_facebook),
            'nama_twitter'      => filter_param($request->nama_twitter),
            'nama_instagram'    => filter_param($request->nama_instagram),
            'google_map'        => filter_param($request->google_map),
            'text_bawah_peta'   => filter_param($request->text_bawah_peta),
            'link_bawah_peta'   => filter_param($request->link_bawah_peta),
            'cara_pesan'        => filter_param($request->cara_pesan),
            'currency'          => filter_param($request->currency),
            'currency_name'          => filter_param($request->currency_name),
            'id_user'           => Session()->get('id_user'),
        ]);
        return redirect('admin/konfigurasi')->with(['sukses' => 'Success Update Data']);
    }

    // Proses
    public function proses_email(Request $request)
    {
        
        request()->validate([
                            'protocol'          => 'required',
                            'smtp_host'          => 'required',
                            'smtp_port'          => 'required',
                            'smtp_timeout'       => 'required',
                            'smtp_user'          => 'required',
                            'smtp_pass'          => 'required'
                            ]);
       DB::table('konfigurasi')->where('id_konfigurasi',filter_param($request->id_konfigurasi))->update([
            'protocol'          => filter_param($request->protocol),
            'smtp_host'         =>$request->smtp_host,
            'smtp_port'         => filter_param($request->smtp_port),
            'smtp_timeout'      => filter_param($request->smtp_timeout),
            'smtp_user'         => filter_param($request->smtp_user),
            'smtp_pass'         => filter_param($request->smtp_pass),
            'id_user'           => Session()->get('id_user'),
        ]);
        return redirect('admin/konfigurasi/email')->with(['sukses' => 'Success Update Data']);
    }

    // logo
    public function proses_logo(Request $request)
    {
        
        request()->validate([
                            'logo'        => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
                            ]);
        // UPLOAD START
        $image                  = $request->file('logo');
        $filenamewithextension  = $request->file('logo')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = str_slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath        = public_path('upload/image/');
        $img = Image::make($image->getRealPath(),array(
            'width'     => 150,
            'height'    => 150,
            'grayscale' => false
        ));
        $img->save($destinationPath.'/'.$input['nama_file']);
        // $destinationPath = public_path('upload/image/');
        // $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD
        DB::table('konfigurasi')->where('id_konfigurasi',$request->id_konfigurasi)->update([
            'id_user'  => Session()->get('id_user'),
            'logo'     => $input['nama_file']
        ]);
        return redirect('admin/konfigurasi/logo')->with(['sukses' => 'Success Update Data']);
    }

    // icon
    public function proses_icon(Request $request)
    {
        
        request()->validate([
                            'icon'        => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
                            ]);
        // UPLOAD START
        $image                  = $request->file('icon');
        $filenamewithextension  = $request->file('icon')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = str_slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath        = public_path('upload/image/');
        $img = Image::make($image->getRealPath(),array(
            'width'     => 150,
            'height'    => 150,
            'grayscale' => false
        ));
        $img->save($destinationPath.'/'.$input['nama_file']);
        // $destinationPath = public_path('upload/image/');
        // $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD
        DB::table('konfigurasi')->where('id_konfigurasi',$request->id_konfigurasi)->update([
            'id_user'  => Session()->get('id_user'),
            'icon'     => $input['nama_file']
        ]);
        return redirect('admin/konfigurasi/icon')->with(['sukses' => 'Success Update Data']);
    }

    // gambar
    public function proses_gambar(Request $request)
    {
        
        request()->validate([
                            'gambar'        => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
                            ]);
        // UPLOAD START
        $image                  = $request->file('gambar');
        $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = str_slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath        = public_path('upload/image/thumbs/');
        $img = Image::make($image->getRealPath(),array(
            'width'     => 150,
            'height'    => 150,
            'grayscale' => false
        ));
        $img->save($destinationPath.'/'.$input['nama_file']);
        $destinationPath = public_path('upload/image/');
        $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD
        DB::table('konfigurasi')->where('id_konfigurasi',$request->id_konfigurasi)->update([
            'id_user'  => Session()->get('id_user'),
            'gambar'     => $input['nama_file']
        ]);
        return redirect('admin/konfigurasi/gambar')->with(['sukses' => 'Success Update Data']);
    }

   
}
