<?php
namespace App\Modules\Mrab\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Mrab extends Model {
    protected $table = 'mrab';
    public $timestamps = true;


    public function listuser($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('mrab_detail')
					->where("id_mrab","=",$id)
					->OrderBy('id', 'ASC')->get();	    
		return $listuser;
	}	
	
	
    public function ajukan($kode)
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('mrab')
					->where("kode","=",$kode)
					->update(['status' => 1]);  
		return $listuser;
	}	

	public function dataall()
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->select(db::raw("properti.*, gambar,count(distinct mrab.id_properti, mrab.tipe_unit) as tunit"))
				->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
				->leftJoin('mrab', 'properti.id','=','mrab.id_properti') 
				->groupBy('properti.id')
				->OrderBy('properti.id', 'ASC')
				->get();	    
		return $data;
	}	
	
	public function rabm($kode)
	{
		$db = DB::connection('mysql');
		$data = $db->table('mrab_material')
				->select(db::raw("mrab_material.*, prodmast.nama, prodmast.merk"))
				->leftJoin('prodmast','mrab_material.prdcd','=','prodmast.prdcd')
				->where("mrab_material.kode","=",$kode)
				->OrderBy('id', 'ASC')
				->get();	    
		return $data;
	}
	
	
	public function jenis_spk()
	{
		$db = DB::connection('mysql');
		$data = $db->table('jenis_spk')
				->OrderBy('id', 'ASC')
				->get();	    
		return $data;
	}
	
	public function prodmast()
	{
		$db = DB::connection('mysql');
		$data = $db->table('prodmast')
				->OrderBy('nama', 'ASC')
				->get();	    
		return $data;
	}
	
	public function job()
	{
		$db = DB::connection('mysql');
		$data = $db->table('jenis_progres_kategori')
				->OrderBy('id', 'ASC')
				->get();	    
		return $data;
	}

	public function namaproperti($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->select(db::raw("properti.nama as nama_properti ")) 
				->where("id","=",$id)
				->get();	    
		return $data;
	}	
	
	public function cekmrab($id_properti,$tipe)
	{
		$db = DB::connection('mysql');
		$data = $db->table('mrab')
				->where("id_properti","=",$id_properti)
				->where("tipe_unit","=",$tipe)
				->where("status","=",2)
				->get();	    
		return $data;
	}	
	
	public function nonaktifkan($kode)
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('mrab')
					->where("kode","=",$kode)
					->update(['status' => 5]);  
		return $listuser;
	}	
	
	public function aktifkan($kode)
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('mrab')
					->where("kode","=",$kode)
					->update(['status' => 2]);  
		return $listuser;
	}	


}
