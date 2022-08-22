<?php
namespace App\Modules\Rusematerial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Rusematerial extends Model {
    protected $table = 'mstran';
    public $timestamps = true;


    public function listbank(){ 

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;
        
	}
	
	
	public function datanya($id_properti,$tanggal1,$tanggal2)
	{
		$db = DB::connection('mysql');
		
		if($id_properti == "all"){
		 
				$data = $db->select("SELECT a.id_properti,a.id_kav,
									c.nama as nama_properti,a.price,
									d.nama as nama_kav,d.tipe as tipe_unit,
									sum(a.qty) as qty, sum(gross) as gross
									FROM mstran a
									left join properti c on a.id_properti = c.id
									left join properti_kav d on a.id_kav = d.id
									where a.rtype='J'
									and tanggal between '$tanggal1' and '$tanggal2' 
									group by docno
									order by d.id asc");	  
									
		}else{
			$data = $db->select("SELECT a.id_properti,a.id_kav,
									c.nama as nama_properti,a.price,
									d.nama as nama_kav,d.tipe as tipe_unit,
									sum(a.qty) as qty, sum(gross) as gross
									FROM mstran a
									left join properti c on a.id_properti = c.id
									left join properti_kav d on a.id_kav = d.id
									where a.rtype='J'
									and tanggal between '$tanggal1' and '$tanggal2'
									and a.id_properti = '$id_properti'
									group by docno
									order by d.id asc");	    
		}
		
		return $data;
	}
	
	public function detail($id)
	{
		
		$db = DB::connection('mysql');
		$listuser = $db->select("SELECT keterangan, a.docno,a.prdcd,b.nama , b.satuan, a.qty,a.price,a.gross
							from mstran a
							left join prodmast b on a.prdcd = b.prdcd
							where a.docno = $id and rtype='J'
						");	    
		return $listuser;
	}
	
	 
	
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
