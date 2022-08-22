<?php
namespace App\Modules\Bayarproyek\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Bayarproyek extends Model {
    protected $table = 'termin_proyek_approval';
    public $timestamps = true;


    public function dataall(){ 

      $db = DB::connection('mysql');
      $listuser = $db->table('spk_proyek')
      ->select(db::raw("spk_proyek.*,mrab_proyek.judul, subkon.nama as nama_subkon, properti.nama as nama_properti, properti_kav.nama as nama_kav, properti_kav.tipe as tipe_unit"))
      ->leftjoin("properti","spk_proyek.id_properti","=","properti.id")            
      ->leftjoin("properti_kav","spk_proyek.id_kav","=","properti_kav.id")         
      ->leftjoin("mrab_proyek","spk_proyek.id_mrabp","=","mrab_proyek.id")    
      ->leftjoin("subkon","spk_proyek.id_subkon","=","subkon.id")            
      ->where("spk_proyek.status","=","4")
      ->where("spk_proyek.kategori","=","Proyek")
      ->OrderBy('spk_proyek.id', 'DESC')->get();	    
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



}
