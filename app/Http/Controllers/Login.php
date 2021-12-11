<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User_model;

class Login extends Controller
{
    // Homepage
    public function index()
    {
        $data = array(  'title'     => 'Login');
        return view('login/index',$data);
    }

    // Cek
    public function cek(Request $request)
    {
        $username   = filter_param($request->username);
        $password   = filter_param($request->password);
        $model      = new User_model();
        $user       = $model->login($username,$password);
        if($user) {
            $request->session()->put('id_user', $user->id_user);
            $request->session()->put('nama', $user->nama);
            $request->session()->put('username', $user->username);
            $request->session()->put('akses_level', $user->akses_level);
            $request->session()->put('LOGIN', TRUE);
            
            return redirect('admin/dasbor')->with(['sukses' => 'Login Success']);
        }else{
            return redirect('login')->with(['warning' => 'Wrong username or password']);
        }
    }

    // Homepage
    public function logout()
    {
        Session()->forget('id_user');
        Session()->forget('nama');
        Session()->forget('username');
        Session()->forget('akses_level');
        Session()->forget('LOGIN');
        return redirect('login')->with(['sukses' => 'Logout Success']);
    }

    // Homepage
    public function lupa()
    {
        $data = array(  'title'     => 'Login');
        return view('login/lupa',$data);
    }
}