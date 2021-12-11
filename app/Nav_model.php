<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nav_model extends Model
{

    // Main page
    public function nav_services()
    {
    	$query = DB::table('t_services')
            ->where('active_status','=','1')
            ->orderBy('services_id','ASC')
            ->get();
        return $query;
    }

     // Main page
    public function nav_tipe()
    {
        $query = DB::table('t_tipe_produk')
            ->orderBy('t_tipe_produk.tipe_id','ASC')
            ->get();
        return $query;
    }

  
}
