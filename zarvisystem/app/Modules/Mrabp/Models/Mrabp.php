<?php
namespace App\Modules\Mrabp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Mrabp extends Model {
    protected $table = 'mrab_proyek';
    public $timestamps = true;

 
	
    public function ajukan($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('mrab_proyek')
					->where("id","=",$id)
					->update(['status' => 1]);  
		return $listuser;
	}	

	public function dataall()
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->select(db::raw("properti.*, gambar,sum(if(mrab_proyek.kategori ='Proyek',1,0)) as tunit"))
				->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
				->leftJoin('mrab_proyek', 'properti.id','=','mrab_proyek.id_properti') 
				->groupBy('properti.id')
				->OrderBy('properti.id', 'ASC')
				->get();	    
		return $data;
	}	
	
	public function rabm($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('mrab_material_proyek')
				->select(db::raw("mrab_material_proyek.*, prodmast.nama"))
				->leftJoin("prodmast","mrab_material_proyek.prdcd","=","prodmast.prdcd")
				->where("id_mrabp","=",$id)
				->OrderBy('id', 'ASC')
				->get();	    
		return $data;
	}
	
	
	public function listjobproyek()
	{
		$db = DB::connection('mysql');
		$data = $db->table('jenis_progres_proyek')
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

	public function viewjob($id)
	{
		$db = DB::connection('mysql');
		$data = $db->select("SELECT a.* , b.nama FROM mrab_job_proyek a
						left join jenis_progres_proyek b on a.id_pekerjaan =b.id where a.id_mrabp='$id'");	    
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
}
