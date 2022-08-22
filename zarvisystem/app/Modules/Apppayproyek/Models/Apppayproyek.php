<?php
namespace App\Modules\Apppayproyek\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Apppayproyek extends Model {
    protected $table = 'termin_proyek_approval';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("select a.*,b.termin,c.id as id_spk,c.kode,c.tanggal_bast, b.termin,b.nilai,b.ket_termin, properti.nama as nama_properti, properti_kav.nama as nama_kav,properti_kav.tipe as tipe_unit
        from termin_proyek_approval a
        left join termin_proyek b on a.id_termin = b.id
        left join spk_proyek c on b.id_spk = c.id
        left join `properti` on c.`id_properti` = `properti`.`id`
        left join `properti_kav` on c.`id_kav` = `properti_kav`.`id`
        where a.status = 1
        and c.kategori = 'Proyek'
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
				left join `spk` on `progres_bangun`.`id_spr` = `spk`.`id_spr`
				left join `jenis_spk` on `progres_bangun`.`jenis_spk` = `jenis_spk`.`id`
				left join `jenis_progres_kategori` on `progres_bangun`.`id_pekerjaan` = `jenis_progres_kategori`.`id`
				where `spk`.`id` = '$id' and jenis_spk='$jenis_spk';");	    
        
        return $listuser;
    }
	public function spk($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT a.*, b.nama as nama_pekerjaan
									FROM progres_proyek a 
									left join jenis_progres_proyek b on a.id_pekerjaan = b.id
									left join spk_proyek c on a.id_spk = c.id
									WHERE a.id_spk ='$id' and c.status = '4';");	    
        
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
		$listuser = $db->select("select a.kode,a.tanggal,a.gross_total,f.judul,
								a.krgbayar,a.tanggal_mulai, a.tanggal_bast,
								c.nama as nama_properti, d.nama as nama_kav, d.tipe as tipe_unit,
								d.luas_tanah,d.luas_bangunan,
								e.nama as nama_subkon,e.alamat,e.kontak
								from spk_proyek a
								left join mrab_proyek f on a.id_mrab = f.id
								left join properti c on a.id_properti=c.id
								left join properti_kav d on a.id_kav=d.id
								left join subkon e on a.id_subkon=e.id
								where a.id = $id;");	    
		return $listuser;
	}
	
	public function terminnya($id){ 

		$db = DB::connection('mysql');
		$listuser = $db->select("select termin_proyek.*, spk_proyek.krgbayar, spk_proyek.kode,termin_proyek_approval.`status` as app_status
									from `termin_proyek`
									left join `termin_proyek_approval` on `termin_proyek`.`id` = `termin_proyek_approval`.`id_termin`
									left join `spk_proyek` on `termin_proyek`.`id_spk` = `spk_proyek`.`id`
									where `termin_proyek`.`id_spk` = '$id'
									order by `termin_proyek`.`id` asc;");	    
		return $listuser;
      
	}


}
