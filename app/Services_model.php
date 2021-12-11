<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Services_model extends Model
{

	protected $table 		= "t_services";
	protected $primaryKey 	= 'services_id';

}
