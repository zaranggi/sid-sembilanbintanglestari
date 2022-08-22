<?php
namespace App\Modules\Setuser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Setuser extends Model {
    protected $table = 'properti_marketing';
    public $timestamps = true;


    public function properti()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('properti')->OrderBy('nama', 'ASC')->get();
	    return $listuser;
    }	 
	
	
    public function akses($id_users)
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('properti_marketing')
					->where('id_users', '=',$id_users)
					->get();
	    return $listuser;
    }	 
}
