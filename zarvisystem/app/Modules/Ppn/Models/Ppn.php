<?php
namespace App\Modules\Ppn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Ppn extends Model {
    protected $table = 'tagihan';
    public $timestamps = true;


    public function listbank(){ 

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;
        
	}
    public function listall($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("select 
						konsumen.nama as nama_konsumen,
						properti.nama as nama_properti,
						properti_kav.nama as nama_kav,
						properti_kav.tipe as tipe_unit,
						sum(tagihan.tagihan) as tagihan,
						sum(tagihan.bayar) as bayar,
						sum(tagihan.kurang) as kurang,
						tagihan.tgl_jatuhtempo,
						tagihan.status,
						tagihan.id_spr
						from `tagihan`
						left join `konsumen_spr` on `tagihan`.`id_spr` = `konsumen_spr`.`id`
						left join `konsumen` on `konsumen_spr`.`id_konsumen` = `konsumen`.`id`
						left join `properti` on `konsumen_spr`.`id_properti` = `properti`.`id`
						left join `properti_kav` on `konsumen_spr`.`id_kav` = `properti_kav`.`id`
						where 
						`konsumen_spr`.`id_properti` = '$id' 
						and `tagihan`.`id_jenis` in(6)
						and tagihan.status_spr = 1
						group by id_spr
						order by tagihan.`id`,`tgl_jatuhtempo` asc;
						");	    
		return $listuser;
	}
	
	public function detail($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("select tagihan.*,
						konsumen.nama as nama_konsumen,
						properti.nama as nama_properti,
						properti_kav.nama as nama_kav,
						properti_kav.tipe as tipe_unit,
						'PPN 10%' as jenis
						from `tagihan`
						left join `konsumen_spr` on `tagihan`.`id_spr` = `konsumen_spr`.`id`
						left join `konsumen` on `konsumen_spr`.`id_konsumen` = `konsumen`.`id`
						left join `properti` on `konsumen_spr`.`id_properti` = `properti`.`id`
						left join `properti_kav` on `konsumen_spr`.`id_kav` = `properti_kav`.`id`
						where 
						`tagihan`.`id_spr` = '$id' 
						and `tagihan`.`id_jenis` in(6) 
						and tagihan.status_spr = 1
						order by tagihan.`id`,`tgl_jatuhtempo` asc;
						");	    
		return $listuser;
	}
	
	
	public function listsatu($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("select 
						konsumen.nama as nama_konsumen,
						properti.nama as nama_properti,
						properti_kav.nama as nama_kav,
						properti_kav.tipe as tipe_unit,
						sum(tagihan.tagihan) as tagihan,
						sum(tagihan.bayar) as bayar,
						sum(tagihan.kurang) as kurang,
						tagihan.tgl_jatuhtempo,
						tagihan.status,
						tagihan.id_spr
						from `tagihan`
						left join `konsumen_spr` on `tagihan`.`id_spr` = `konsumen_spr`.`id`
						left join `konsumen` on `konsumen_spr`.`id_konsumen` = `konsumen`.`id`
						left join `properti` on `konsumen_spr`.`id_properti` = `properti`.`id`
						left join `properti_kav` on `konsumen_spr`.`id_kav` = `properti_kav`.`id`
						where 
						`konsumen`.`kode` = '$id' 
						and `tagihan`.`id_jenis` in(6)
						and tagihan.status_spr = 1
						group by id_spr
						order by tagihan.`id`,`tgl_jatuhtempo` asc;");	    
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
