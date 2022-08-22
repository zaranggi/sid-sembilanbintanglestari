<?php
namespace App\Modules\Realadm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Realadm extends Model {
    protected $table = 'realisasi_kpr2';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
        $data = $db->select("select a.id,c.nama as nama_properti,d.nama as nama_kav,d.tipe as tipe_unit,
        f.nama as nama_konsumen,g.name as nama_marketing,
        a.tanggal_real,a.log_kpr_bank as bank,a.sp3k_nominal as total_kpr, 
        a.realisasi_rp as terbayar
        from konsumen_spr a
        left join properti c on a.id_properti = c.id
        left join properti_kav d on a.id_kav = d.id
        left join konsumen f on a.id_konsumen = f.id
        left join users g on a.id_marketing = g.id
        where  a.status_spr = 1
        and cara_bayar_unit = 'kpr'
        ");  
        return $data;
    }	
    
    public function datasatu($id)
	{
        $db = DB::connection('mysql');
        $data = $db->select("select a.kode,a.id,a.tgl_transaksi,
        c.nama as nama_properti,d.nama as nama_kav,d.tipe as tipe_unit,
        f.nama as nama_konsumen,g.name as nama_marketing,
        f.idcard,f.alamat,f.telp,
        a.tanggal_real,a.tanggal_sp3k,a.log_kpr_bank as bank,a.sp3k_nominal, 
        a.realisasi_rp as terbayar
        from konsumen_spr a
        left join properti c on a.id_properti = c.id
        left join properti_kav d on a.id_kav = d.id
        left join konsumen f on a.id_konsumen = f.id
        left join users g on a.id_marketing = g.id
        where  a.status_spr = 1
        and a.cara_bayar_unit = 'kpr' 
        and a.id = '$id'");
 
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
        $data = $db->select("select *,b.nama as nama_bank_pt from realisasi2 a 
                            left join bank_pt b on a.bank_pt = b.id
                            where id_spr='$id'");
        return $data;
        
    } 

    
    
    public function cekreal($id){ 

		$db = DB::connection('mysql');
        $data = $db->select("select * from realisasi_kpr2 where id_spr = '$id'");
        return $data;
        
    } 



    

}
