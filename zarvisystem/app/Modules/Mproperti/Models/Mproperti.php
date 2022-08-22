<?php
namespace App\Modules\Mproperti\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Mproperti extends Model {
    protected $table = 'properti';
    public $timestamps = true;

	

    public function dataall()
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
		->select(db::raw("properti.*, gambar,count(distinct properti_kav.id) as tunit"))
				->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
				->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti')
				->groupBy('properti.id')
				->OrderBy('properti.id', 'ASC')
				->get();	    
		return $data;
    }	

    public function bank()
	{
		$db = DB::connection('mysql');
		$data = $db->table('bank_pt')->OrderBy('id', 'ASC')->get();	    
		return $data;
    }	
	 
	
    public function gambar($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti_img')
					->where('id_properti','=',$id)
					->OrderBy('id', 'ASC')
					->get();	    
		return $data;
    }	
	 

}
