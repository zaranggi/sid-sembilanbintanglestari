<?php
namespace App\Modules\Progkonsumen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Progkonsumen extends Model {
    protected $table = 'users';
    public $timestamps = true;


    public function listuser()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('users')->OrderBy('name', 'ASC')->get();	    return $listuser;
    }	 
}
