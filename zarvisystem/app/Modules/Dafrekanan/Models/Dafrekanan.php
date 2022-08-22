<?php
namespace App\Modules\Dafrekanan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Dafrekanan extends Model {
    protected $table = 'rekanan';
    public $timestamps = true;


    public function dataall()
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->select(db::raw("properti.*, gambar,count(properti_kav.nama) as tunit"))
				->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
				->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti')
				->groupBy('properti.id')
				->OrderBy('properti.id', 'ASC')
				->get();	    
		return $data;
	}	
	 
    
}
