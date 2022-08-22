<?php
namespace App\Modules\Rpmaterial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Rpmaterial extends Model {
    protected $table = 'mstran';
    public $timestamps = true;


    public function listbank(){ 

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;
        
	}
	public function listall($id_properti,$tanggal1,$tanggal2)
	{
		$db = DB::connection('mysql');
		if($id_properti == "all"){
				$listuser = $db->select("SELECT a.docno,a.keterangan, tgl_bayar,jumlah_bayar,created_by,a.pembayaran,id_properti,c.nama as nama_properti, b.nama as nama_vendor,b.alamat as alamat_vendor  FROM po_bayar a
									left join rekanan b on a.id_vendor = b.id
									left join properti c on a.id_properti = c.id
									where a.jumlah_bayar > 0
									and tgl_bayar between '$tanggal1' and '$tanggal2'
									order by tgl_bayar desc");	    	
		}else{
			$listuser = $db->select("SELECT a.docno, a.keterangan,tgl_bayar,jumlah_bayar,created_by,a.pembayaran,id_properti,c.nama as nama_properti, b.nama as nama_vendor,b.alamat as alamat_vendor  
									FROM po_bayar a
									left join rekanan b on a.id_vendor = b.id
									left join properti c on a.id_properti = c.id
									where a.jumlah_bayar > 0
									and id_properti = $id_properti 
									and tgl_bayar between '$tanggal1' and '$tanggal2'
									order by tgl_bayar desc");	    
		}
		
		return $listuser;
	}
	
	public function detail($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("SELECT a.docno,a.prdcd,b.nama , b.satuan, a.qty,a.price,a.gross
							from mstran a
							left join prodmast b on a.prdcd = b.prdcd
							where a.docno = $id and rtype='B'
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
