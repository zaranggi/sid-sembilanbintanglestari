<?php
namespace App\Modules\Munit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Munit extends Model {
    protected $table = 'properti_kav';
    public $timestamps = true;


    public function dataall()
	{
		$db = DB::connection('mysql');
        if(Auth::user()->id_jabatan == 9){
		$data = $db->table('properti')
				->select(db::raw("properti.*, gambar,count(distinct properti_kav.id) as tunit"))
				->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
				->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti')
                ->leftJoin('properti_marketing', 'properti.id','=','properti_marketing.id_properti')
                ->where('properti_marketing.id_users','=',Auth::user()->id)
				->groupBy('properti.id')
				->OrderBy('properti.id', 'ASC')
                ->get();
        }else{
            $data = $db->table('properti')
			->select(db::raw("properti.*, gambar,count(distinct properti_kav.id) as tunit"))
            ->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
            ->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti')
            ->groupBy('properti.id')
            ->OrderBy('properti.id', 'ASC')
            ->get();
        }	    
		return $data;
	}	
	
	public function listunit($id)
	{
		$db = DB::connection('mysql');
		if(Auth::user()->id_jabatan == 9){
			$data = $db->table('properti_kav')
			->select(db::raw("properti_kav.* , properti.nama as nama_properti,jenis_status_kav.nama as nama_status"))
			->leftJoin('properti', 'properti_kav.id_properti','=','properti.id')
			->leftJoin('jenis_status_kav', 'properti_kav.status','=','jenis_status_kav.id')
			->leftJoin('properti_marketing', 'properti.id','=','properti_marketing.id_properti')
			->where('properti_marketing.id_users','=',Auth::user()->id)
			->where('properti_kav.id_properti','=', $id) 
			->OrderBy('properti_kav.id', 'ASC')
			->get();	   
		}else{
			$data = $db->table('properti_kav')
			->select(db::raw("properti_kav.* , properti.nama as nama_properti,jenis_status_kav.nama as nama_status"))
			->leftJoin('properti', 'properti_kav.id_properti','=','properti.id')
			->leftJoin('jenis_status_kav', 'properti_kav.status','=','jenis_status_kav.id')
			->where('properti_kav.id_properti','=', $id) 
			->OrderBy('properti_kav.id', 'ASC')
			->get();	   
		}
		 
		return $data;
	}	
	
	public function data_properti($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->select(db::raw("properti.*, gambar,count(distinct properti_kav.nama) as tunit"))
				->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
				->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti')
				->where('properti.id','=',$id)
				->groupBy('properti.id')
				->OrderBy('properti.id', 'ASC')
				->get();	    
		return $data;
	}	

	
	public function gambar($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti_kav_img')
				->select(db::raw("gambar"))
				->where('id_kav','=',$id) 
				->get();	   

		return $data;
	}
    
}
