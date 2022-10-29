<?php
namespace App\Modules\Um\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Um extends Model {
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
						and `tagihan`.`id_jenis` = 2
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
						properti_kav.tipe as tipe_unit
						from `tagihan`
						left join `konsumen_spr` on `tagihan`.`id_spr` = `konsumen_spr`.`id`
						left join `konsumen` on `konsumen_spr`.`id_konsumen` = `konsumen`.`id`
						left join `properti` on `konsumen_spr`.`id_properti` = `properti`.`id`
						left join `properti_kav` on `konsumen_spr`.`id_kav` = `properti_kav`.`id`
						where 
						`tagihan`.`id_spr` = '$id' 
						and `tagihan`.`id_jenis` = 2 
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
						and `tagihan`.`id_jenis` = 2
						and tagihan.status_spr = 1
						group by id_spr
						order by tagihan.`id`,`tgl_jatuhtempo` asc;");	    
		return $listuser;
	}
	
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

	
	public function datacetak($kode)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("select a.*,b.kode as kode_mou,c.nama as nama_properti,
		d.nama as nama_kav,e.kode as kode_konsumen,f.kode as kode_pembayaran,d.tipe as tipe_unit
		from mtran_konsumen a
		left join konsumen_spr b on a.id_spr = b.id
		left join properti c on b.id_properti = c.id
		left join properti_kav d on b.id_kav = d.id
		left join konsumen e on b.id_konsumen = e.id
		left join mtran f on a.kode = f.kode_tagihan
		where a.id='$kode'; ");	    
		return $listuser;
	}
	



	
}
