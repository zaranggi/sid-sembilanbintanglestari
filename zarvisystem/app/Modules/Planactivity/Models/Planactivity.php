<?php
namespace App\Modules\Planactivity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Planactivity extends Model {
	protected $table = 'marketing_plan';
	protected $primaryKey = 'id'; // or null	
	public $timestamps = true;

    public function data()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('prodmast')
		->select(db::raw("prodmast.*, stmast.qty"))
		->leftjoin("stmast", "prodmast.prdcd","=","stmast.prdcd")
		->OrderBy('prodmast.prdcd', 'ASC')
		->get();	    
		return $listuser;
	}	
	 
    public function regencies($id)
	{
	    $list= DB::table("regencies")
            ->select("name","id")
            ->where('province_id','=',
                DB::raw("(SELECT id FROM provinces WHERE name = '".$id."')"))->orderBy("name","asc")
			->get();
	        return $list;
	}

 
}
