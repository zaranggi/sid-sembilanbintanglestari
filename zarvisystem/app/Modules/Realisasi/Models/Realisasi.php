<?php
namespace App\Modules\Realisasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Realisasi extends Model {
    protected $table = 'realisasi_kpr';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
        $data = $db->select("select a.id,c.nama as nama_properti,d.nama as nama_kav,d.tipe as tipe_unit,
        f.nama as nama_konsumen,g.name as nama_marketing,
        a.tanggal_real,a.log_kpr_bank as bank,a.sp3k_nominal as total_kpr,
        e.terbayar,e.dana_ditahan
        from konsumen_spr a
        left join properti c on a.id_properti = c.id
        left join properti_kav d on a.id_kav = d.id
        left join realisasi_kpr e on a.id = e.id_spr
        left join konsumen f on a.id_konsumen = f.id
        left join users g on a.id_marketing = g.id
        where  a.status_spr = 1
        and cara_bayar_unit = 'kpr'
        and realisasi = 'Realisasi';
        ");  
        return $data;
    }	
    
    public function datasatu($id)
	{
		$db = DB::connection('mysql');
        $data = $db->select("select b.kode,b.id,b.tgl_transaksi,c.nama as nama_properti,d.nama as nama_kav,d.tipe as tipe_unit,
        f.nama as nama_konsumen,f.idcard,f.alamat,f.telp,g.name as nama_marketing,
        b.tanggal_real as tanggal_realisasi,b.log_kpr_bank as bank, e.terbayar,e.dana_ditahan,
        b.tanggal_sp3k,b.sp3k_nominal,b.gross_total
        from konsumen_spr b
        left join properti c on b.id_properti = c.id
        left join properti_kav d on b.id_kav = d.id
        left join realisasi_kpr e on b.id = e.id_spr
        left join konsumen f on b.id_konsumen = f.id
        left join users g on b.id_marketing = g.id 
        where  b.status_spr = 1
        and cara_bayar_unit = 'kpr'
        and realisasi = 'Realisasi'
        and b.id = '$id'
        ");  
        return $data;
    }	
    
    public function listbank(){ 

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;
        
    }
    
    
    public function bank_pt(){ 

		$db = DB::connection('mysql');
		$data = $db->table('bank_pt')->OrderBy('nama', 'ASC')->get();
        return $data;
        
    }
    
    public function properti(){ 

		$db = DB::connection('mysql');
		$data = $db->table('properti')->OrderBy('nama', 'ASC')->get();
        return $data;
        
    }
    
    
    public function realisasi($id){ 

		$db = DB::connection('mysql');
        $data = $db->select("select *,b.nama as nama_bank_pt from realisasi a 
                            left join bank_pt b on a.bank_pt = b.id
                            where id_spr='$id'");
        return $data;
        
    }  
    public function cekreal($id){ 

		$db = DB::connection('mysql');
        $data = $db->select("select * from realisasi_kpr where id_spr = '$id'");
        return $data;
        
    } 
	 public function bpembangunan($id_properti,$id_kav){ 

		$db = DB::connection('mysql');
        $data = $db->select("
							select a.id as id_spk,id_properti,id_kav,sum(gross_total) as nilai_termin, 
							sum(a.krgbayar) as kurang_bayar, sum(gross_total) - sum(krgbayar) as jumlah_bayar
							from spk a where a.`status`= 4 and id_properti = '$id_properti' and id_kav = '$id_kav'");
        return $data;
        
    } 
	
	public function brevisi($id_properti,$id_kav){ 

		$db = DB::connection('mysql');
        $data = $db->select("select a.id as id_spk,id_properti,id_kav,
							sum(gross_total) as nilai_termin_rev, sum(a.krgbayar) as kurang_bayar_rev, 
							sum(gross_total) - sum(krgbayar) as jumlah_bayar_rev
							from spk_proyek a where a.`status`= 4 and id_properti = '$id_properti' and id_kav = '$id_kav'
							");
        return $data;
        
    } 
	public function bmaterial($id_properti,$id_kav){ 

		$db = DB::connection('mysql');
        $data = $db->select("select id_properti,id_kav,sum(gross) as biaya_material 
								from mstran where rtype='J' 
								and id_properti = '$id_properti' and id_kav = '$id_kav'
							");
        return $data;
        
    } 
	public function konsumen_bayar($id_spr){ 

		$db = DB::connection('mysql');
        $data = $db->select("select id_spr,
            sum(if(id_jenis=1,tagihan,0)) as tagihan1, sum(if(id_jenis=1,bayar,0)) as bayar1,
            sum(if(id_jenis=2,tagihan,0)) as tagihan2, sum(if(id_jenis=2,bayar,0)) as bayar2,
            sum(if(id_jenis=3,tagihan,0)) as tagihan3, sum(if(id_jenis=3,bayar,0)) as bayar3,
            sum(if(id_jenis=4,tagihan,0)) as tagihan4, sum(if(id_jenis=4,bayar,0)) as bayar4,
            sum(if(id_jenis=5,tagihan,0)) as tagihan5, sum(if(id_jenis=5,bayar,0)) as bayar5,
            sum(if(id_jenis=6,tagihan,0)) as tagihan6, sum(if(id_jenis=6,bayar,0)) as bayar6,
            sum(if(id_jenis=7,tagihan,0)) as tagihan7, sum(if(id_jenis=7,bayar,0)) as bayar7
            from tagihan where id_spr='$id_spr'");
        return $data;
        
    } 
 




    

}
