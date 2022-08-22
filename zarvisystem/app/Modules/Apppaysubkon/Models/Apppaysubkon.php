<?php
namespace App\Modules\Apppaysubkon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Apppaysubkon extends Model {
    protected $table = 'termin_approval';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("select a.*,b.termin,c.id as id_spk,c.kode,c.tanggal_bast, b.termin,b.nilai,b.ket_termin, properti.nama as nama_properti, properti_kav.nama as nama_kav,properti_kav.tipe as tipe_unit
        from termin_approval a
        left join termin b on a.id_termin = b.id
        left join spk c on b.id_spk = c.id
        left join `properti` on c.id_properti = `properti`.`id`
        left join `properti_kav` on c.id_kav = `properti_kav`.`id`
        where a.status = 1
        order by a.`id` desc;");	    
        return $listuser;
    }	 

    public function updspk($idspk){ 

        $db = DB::connection('mysql');
        
        $data = $db->update('update spk a,
        (select id_spk,sum(bayar) as total_bayar from termin_approval where status= 1 and id_spk= ? ) b
        set a.krgbayar = a.krgbayar - b.total_bayar
        where a.id = b.id_spk', [$idspk]); 
        return $data;
        
    }
    
   public function progres($id,$jenis_spk)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("
				select progres_bangun.*,jenis_spk.nama_spk, jenis_progres_kategori.nama as nama_pekerjaan
				from `progres_bangun`
				left join `spk` on `progres_bangun`.`id_spk` = `spk`.`id`
				left join `jenis_spk` on `progres_bangun`.`jenis_spk` = `jenis_spk`.`id`
				left join `jenis_progres_kategori` on `progres_bangun`.`id_pekerjaan` = `jenis_progres_kategori`.`id`
				where `spk`.`id` = '$id' and jenis_spk='$jenis_spk';");	    
        
        return $listuser;
    }
	
	public function spk($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT a.*,b.nama_spk, ((bobot/t) * c.ach) as achiev 
							FROM spk a
							left join jenis_spk b on a.id_jenis=b.id
							left join ( select jenis_spk,id_spk, count(*) as t, 
							sum(if(`status` = 1,1,0)) as ach 
							from progres_bangun where id_spk='$id' group by jenis_spk )
							c on a.id_jenis = c.jenis_spk
							WHERE a.id ='$id' and a.status = '4';");	    
        
        return $listuser;
    }


    
    public function cekspk($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT KODE FROM SPK WHERE ID= $id");	    
        
        return $listuser;
    }
	
	public function detailnya($id){
		$db = DB::connection('mysql');
		$listuser = $db->select("select a.kode,a.tanggal,a.gross_total,a.krgbayar,a.tanggal_mulai, a.tanggal_bast,
								c.nama as nama_properti, d.nama as nama_kav, d.tipe as tipe_unit,
								d.luas_tanah,d.luas_bangunan,
								e.nama as nama_subkon,e.alamat,e.kontak
								from spk a
								left join properti c on a.id_properti=c.id
								left join properti_kav d on a.id_kav=d.id
								left join subkon e on a.id_subkon=e.id
								where a.id = $id;");	    
		return $listuser;
	}
	
	public function terminnya($id){ 

		$db = DB::connection('mysql');
		$listuser = $db->select("select termin.*, spk.krgbayar, spk.kode,termin_approval.`status` as app_status
								from `termin`
								left join `termin_approval` on `termin`.`id` = `termin_approval`.`id_termin`
								left join `spk` on `termin`.`id_spk` = `spk`.`id`
								where `termin`.`id_spk` = '$id'
								order by `termin`.`id` asc;");	    
		return $listuser;
      
	}



}
