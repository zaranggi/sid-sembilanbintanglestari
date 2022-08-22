<?php
namespace App\Modules\Rberkas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Rberkas extends Model {
    protected $table = 'konsumen_spr';
    public $timestamps = true;
 
	public function baru($tanggal1,$tanggal2,$id_properti)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){ 
				$data = $db->select("SELECT b.nama as nama_konsumen,d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										a.realisasi_rp,c.name nama_marketing,a.tgl_transaksi as tanggalnya	
									FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and tgl_transaksi between '$tanggal1' and '$tanggal2'
										
									");
									//and log_kpr = 'Belum Pengajuan'
           
        }else{
            
                $data = $db->select("SELECT b.nama as nama_konsumen,d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										a.realisasi_rp,c.name nama_marketing, a.tgl_transaksi as tanggalnya			
									FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and a.id_properti = '$id_properti'
										and a.tgl_transaksi between '$tanggal1' and '$tanggal2'
									
									");
									//	and a.log_kpr = 'Belum Pengajuan'
        }
		
        
        return $data;
    }	
	
	public function baru_rekap($tanggal1,$tanggal2,$id_properti)
	{
		
		$db = DB::connection('mysql');	

         if($id_properti == "all"){ 
				$data = $db->select("SELECT count(*) as total, sum(gross_rev_kpr) as rp				
									FROM konsumen_spr  a 
										where cara_bayar_unit = 'kpr'
										and tgl_transaksi between '$tanggal1' and '$tanggal2'
										
									");
									//and log_kpr = 'Belum Pengajuan'
           
        }else{            
                $data = $db->select("SELECT count(*) as total, sum(gross_rev_kpr) as rp				
										FROM konsumen_spr  a 
										where cara_bayar_unit = 'kpr'
										and tgl_transaksi between '$tanggal1' and '$tanggal2'
										and a.id_properti = '$id_properti' 
									");
									//and log_kpr = 'Belum Pengajuan'
        }        
        return $data;
    }

	public function proses($tanggal1,$tanggal2,$id_properti)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){ 
				$data = $db->select("SELECT b.nama as nama_konsumen,d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										c.name nama_marketing,a.sp3k_nominal,a.realisasi_rp,f.tanggal as tanggalnya	
									FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										left join konsumen_kpr f on a.id = f.id_spr
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and f.tanggal between '$tanggal1' and '$tanggal2'
									");
									//and log_kpr = 'Proses'
           
        }else{
            
                $data = $db->select("SELECT b.nama as nama_konsumen,d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										c.name nama_marketing,a.sp3k_nominal,a.realisasi_rp,f.tanggal as tanggalnya				
									FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										left join konsumen_kpr f on a.id = f.id_spr
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and f.tanggal between '$tanggal1' and '$tanggal2'										
										and a.id_properti = '$id_properti' 
									");
									//and log_kpr = 'Proses'
        }
		
        
        return $data;
    }	
	
	public function proses_rekap($tanggal1,$tanggal2,$id_properti)
	{
		
		$db = DB::connection('mysql');	

         if($id_properti == "all"){ 
				$data = $db->select("SELECT count(*) as total, sum(gross_rev_kpr) as rp				
									FROM konsumen_spr  a 
									left join konsumen_kpr b on a.id = b.id_spr
										where cara_bayar_unit = 'kpr'
										and b.tanggal between '$tanggal1' and '$tanggal2'
									");
									
									//and log_kpr = 'Proses'
           
        }else{            
                $data = $db->select("SELECT count(*) as total, sum(gross_rev_kpr) as rp				
										FROM konsumen_spr  a 
										left join konsumen_kpr b on a.id = b.id_spr
										where cara_bayar_unit = 'kpr'
										and b.tanggal between '$tanggal1' and '$tanggal2'
										and a.id_properti = '$id_properti' 
									");
									//and log_kpr = 'Proses'
        }        
        return $data;
    }

	public function acc($tanggal1,$tanggal2,$id_properti)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){ 
				$data = $db->select("SELECT b.nama as nama_konsumen,d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										a.sp3k_nominal as rp, c.name nama_marketing,a.tanggal_sp3k as tanggalnya				
									FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										left join konsumen_kpr f on a.id = f.id_spr
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and f.tanggal_sp3k between '$tanggal1' and '$tanggal2'
										
									");
									//and log_kpr = 'ACC'
           
        }else{
            
                $data = $db->select("SELECT b.nama as nama_konsumen,d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										a.sp3k_nominal as rp,c.name nama_marketing,a.tanggal_sp3k as tanggalnya						
									FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										left join konsumen_kpr f on a.id = f.id_spr
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and f.tanggal_sp3k between '$tanggal1' and '$tanggal2'
										and a.id_properti = '$id_properti' 
									");
									//and log_kpr = 'ACC'
        }
		
        
        return $data;
    }	
	
	public function acc_rekap($tanggal1,$tanggal2,$id_properti)
	{
		
		$db = DB::connection('mysql');	

         if($id_properti == "all"){ 
				$data = $db->select("SELECT count(*) as total, sum(sp3k_nominal) as rp				
									FROM konsumen_spr  a  
									left join konsumen_kpr f on a.id = f.id_spr
										where cara_bayar_unit = 'kpr'
										and f.tanggal_sp3k between '$tanggal1' and '$tanggal2'										
									");
									//and log_kpr = 'ACC'
           
        }else{            
                $data = $db->select("SELECT count(*) as total, sum(sp3k_nominal) as rp				
										FROM konsumen_spr  a 
										left join konsumen_kpr f on a.id = f.id_spr
										where cara_bayar_unit = 'kpr'
										and f.tanggal_sp3k between '$tanggal1' and '$tanggal2'										
										and a.id_properti = '$id_properti' 
									");
									//and log_kpr = 'ACC'
        }        
        return $data;
    }	

public function realisasi($tanggal1,$tanggal2,$id_properti)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){ 
				$data = $db->select("SELECT b.nama as nama_konsumen,d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										realisasi_rp as rp,
										a.realisasi_rp,c.name nama_marketing,a.tanggal_real as tanggalnya				
									FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										left join konsumen_kpr f on a.id = f.id_spr
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and a.tanggal_real between '$tanggal1' and '$tanggal2' 
									");
           
        }else{
            
                $data = $db->select("SELECT b.nama as nama_konsumen,d.nama as nama_properti,e.nama as nama_kav,
										e.tipe as tipe_unit,a.log_kpr_bank,a.tanggal_real,
										a.realisasi_rp as rp,c.name nama_marketing,a.tanggal_real as tanggalnya			
									FROM konsumen_spr  a
										left join konsumen b on a.id_konsumen = b.id
										left join users c on a.id_marketing = c.id
										left join properti d on a.id_properti = d.id
										left join properti_kav e on a.id_kav = e.id
										left join konsumen_kpr f on a.id = f.id_spr
										where status_spr=1
										and cara_bayar_unit = 'kpr'
										and a.tanggal_real between '$tanggal1' and '$tanggal2' 
										and a.id_properti = '$id_properti' 
									");
        }
		
        
        return $data;
    }	
	
	public function realisasi_rekap($tanggal1,$tanggal2,$id_properti)
	{
		
		$db = DB::connection('mysql');	

         if($id_properti == "all"){ 
				$data = $db->select("SELECT count(*) as total, sum(realisasi_rp) as rp				
									FROM konsumen_spr  a 
										where cara_bayar_unit = 'kpr'
										and tanggal_real between '$tanggal1' and '$tanggal2' 
									");
           
        }else{            
                $data = $db->select("SELECT count(*) as total, sum(realisasi_rp) as rp				
										FROM konsumen_spr  a 
										where cara_bayar_unit = 'kpr'
										and tanggal_real between '$tanggal1' and '$tanggal2'
										and a.id_properti = '$id_properti' 
									");
									//and log_kpr = 'Realisasi KPR'
        }        
        return $data;
    }		
	 
	 
}
