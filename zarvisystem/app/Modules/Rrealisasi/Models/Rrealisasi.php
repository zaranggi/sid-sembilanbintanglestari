<?php
namespace App\Modules\Rrealisasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Rrealisasi extends Model {
    protected $table = 'konsumen_spr';
    public $timestamps = true;
 
	public function listall($tanggal1,$tanggal2,$id_properti)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){ 
				$data = $db->select("SELECT b.nama as nama_konsumen,d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										a.realisasi_rp,c.name nama_marketing				
									FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and tanggal_real between '$tanggal1' and '$tanggal2'
									");
           
        }else{
            
                $data = $db->select("SELECT b.nama as nama_konsumen, d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										a.realisasi_rp, c.name nama_marketing	 
										FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and a.id_properti = '$id_properti'
										and tanggal_real between '$tanggal1' and '$tanggal2'
									");
        }
		
        
        return $data;
    }	
	
	public function listrekap($tanggal1,$tanggal2,$id_properti)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){ 
				$data = $db->select("SELECT count(*) as unit, sum(realisasi_rp) as total FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and tanggal_real between '$tanggal1' and '$tanggal2'
									");
           
        }else{
            
                $data = $db->select("SELECT count(*) as unit, sum(realisasi_rp) as total FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and a.id_properti = '$id_properti'
										and tanggal_real between '$tanggal1' and '$tanggal2'
									");
        }
		
		
        
        return $data;
    }	
	 
	 
}
