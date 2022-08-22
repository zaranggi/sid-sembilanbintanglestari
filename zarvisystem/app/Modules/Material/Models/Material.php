<?php
namespace App\Modules\Material\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Material extends Model {
	protected $table = 'prodmast';
	protected $primaryKey = 'prdcd'; // or null	
	public $timestamps = true;

    public function data()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('prodmast')
		->select(db::raw("prodmast.*, rekanan.nama as nama_rekanan , stmast.qty"))
		->leftjoin("stmast", "prodmast.prdcd","=","stmast.prdcd")
		->leftjoin("rekanan", "prodmast.id_vendor","=","rekanan.id")
		->OrderBy('prodmast.prdcd', 'ASC')
		->get();	    
		return $listuser;
	}	
	public function data2($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('prodmast')
		->leftjoin("stmast", "prodmast.prdcd","=","stmast.prdcd")
		->leftjoin("rekanan", "prodmast.id_vendor","=","rekanan.id")
		->where("prodmast.prdcd", "=",$id)
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
	 
    public function vendor()
	{
	    $list= DB::table("rekanan")
            ->select("nama","alamat","id")
			->get();
	        return $list;
	}

 
}
