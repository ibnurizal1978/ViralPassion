<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class User extends Controller
{
    // Index
    public function index()
    {
    	
		$user 	= DB::table('users')->orderBy('id_user','DESC')->get();

		$data = array(  'title'     => 'Users',
						'user'      => $user,
                        'content'   => 'admin/user/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Index
    public function edit($id_user)
    {
        
        $user   = DB::table('users')->where('id_user',$id_user)->orderBy('id_user','DESC')->first();

        $data = array(  'title'     => 'Edit User',
                        'user'      => $user,
                        'content'   => 'admin/user/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

   

    // tambah
    public function tambah(Request $request)
    {
    	
    	request()->validate([
                            'nama'     => 'required',
					        'username' => 'required|unique:users',
					        'password' => 'required',
					        ]);
        
        DB::table('users')->insert([
                'nama'          => filter_param($request->nama),
                'email'         => filter_param($request->email),
                'username'      => filter_param($request->username),
                'password'      => sha1(filter_param($request->password)),
                'akses_level'   => filter_param($request->akses_level)
            ]);

        return redirect('admin/user')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function proses_edit(Request $request)
    {
    	
    	request()->validate([
					        'nama'     => 'required',
                            'username' => 'required',
                            'password' => 'required', 
					        ]);
       
       $slug_user = str_slug(filter_param($request->nama), '-');
            DB::table('users')->where('id_user',filter_param($request->id_user))->update([
                'nama'          => filter_param($request->nama),
                'email'         => filter_param($request->email),
                'username'      => filter_param($request->username),
                'password'      => sha1(filter_param($request->password)),
                'akses_level'   => filter_param($request->akses_level)
            ]);

        return redirect('admin/user')->with(['sukses' => 'Data telah diupdate']);
    }

    
}
