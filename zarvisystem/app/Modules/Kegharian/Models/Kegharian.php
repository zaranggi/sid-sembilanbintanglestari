<?php

namespace App\Modules\Kegharian\Models;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

/**

 * @property array|null|string name

 */

class Kegharian extends Model {

    protected $table = 'marketing_harian';

    public $timestamps = true;
 

    public function list() 
	{

		$id_users = Auth::user()->id;

		$db = DB::connection('mysql');

		$listuser = $db->select("SELECT A.id,A.nama FROM properti A 
			right JOIN properti_marketing B ON A.id = B.id_properti
			WHERE B.id_users='$id_users'");	    

		return $listuser;

    }	 

}

