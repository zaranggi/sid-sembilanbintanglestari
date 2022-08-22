<?php
namespace App\Modules\Lapsales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Lapsales extends Model {
    protected $table = 'konsumen_spr';
    public $timestamps = true;


    public function sales_all()
	{
		$db = DB::connection('mysql');
		$data = $db->table('users')
				->select(db::raw("users.name as nama_marketing,users.phone as telp,
				sum(if(konsumen.iskonsumen = 1, 1, 0)) as konsumen,
				sum(if(konsumen.iskonsumen = 0, 1, 0)) as ckonsumen,
				"))
				->leftJoin('konsumen', 'users.id','=','konsumen.id_marketing')
				->groupBy('users.id')
				->OrderBy('users.name', 'ASC')
				->get();	    
		return $data;
	}	

	public function listall($tanggal1,$tanggal2,$id_properti,$id_marketing)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){
            if($id_marketing == "all"){
				
				$data = $db->table('users')
				->select(db::raw("users.name as nama_marketing,users.phone as telp,konsumen.id_marketing,
				sum(if(konsumen_spr.status_spr = 1 AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as penjualan,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as kpr,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as kpr_rp,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as tempo,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as tempo_rp
				"))
				->leftJoin('konsumen', 'users.id','=','konsumen.id_marketing')
				->leftJoin('konsumen_spr', 'konsumen.id','=','konsumen_spr.id_konsumen') 
				->where("users.id_jabatan","=","9")
				->groupBy('users.id')
				->OrderBy('users.name', 'ASC')
				->get();	
            }else{
				$data = $db->table('users')
				->select(db::raw("users.name as nama_marketing,users.phone as telp,konsumen.id_marketing,
				sum(if(konsumen_spr.status_spr = 1 AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as penjualan,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as kpr,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as kpr_rp,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as tempo,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as tempo_rp
				"))
				->leftJoin('konsumen', 'users.id','=','konsumen.id_marketing')
				->leftJoin('konsumen_spr', 'konsumen.id','=','konsumen_spr.id_konsumen') 
				->where("users.id_jabatan","=","9")
				->where("konsumen.id_marketing",'=',$id_marketing)
				->groupBy('users.id')
				->OrderBy('users.name', 'ASC')
				->get();	 	    
            }
        }else{
            if($id_marketing == "all"){
				$data = $db->table('users')
				->select(db::raw("users.name as nama_marketing,users.phone as telp,konsumen.id_marketing,
				sum(if(konsumen_spr.status_spr = 1 AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as penjualan,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as kpr,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as kpr_rp,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as tempo,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as tempo_rp
				"))
				->leftJoin('konsumen', 'users.id','=','konsumen.id_marketing')
				->leftJoin('konsumen_spr', 'konsumen.id','=','konsumen_spr.id_konsumen') 
				->where("konsumen.id_properti",'=',$id_properti)
				->where("users.id_jabatan","=","9")
				->groupBy('users.id')
				->OrderBy('users.name', 'ASC')
				->get();	 	    
            }else{
                $data = $db->table('users')
				->select(db::raw("users.name as nama_marketing,users.phone as telp,konsumen.id_marketing,
				sum(if(konsumen_spr.status_spr = 1 AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as penjualan,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as kpr,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as kpr_rp,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as tempo,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as tempo_rp
				"))
				->leftJoin('konsumen', 'users.id','=','konsumen.id_marketing')
				->leftJoin('konsumen_spr', 'konsumen.id','=','konsumen_spr.id_konsumen') 
				->where("konsumen.id_properti",'=',$id_properti)
				->where("konsumen.id_marketing",'=',$id_marketing)
				->where("users.id_jabatan","=","9")
				->groupBy('users.id')
				->OrderBy('users.name', 'ASC')
				->get();	 	        
            }

        }
		
        
        return $data;
    }	
	
	public function listrekap($tanggal1,$tanggal2,$id_properti,$id_marketing)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){
            if($id_marketing == "all"){
				
				$data = $db->table('konsumen_spr')
				->select(db::raw("
				sum(if(konsumen_spr.status_spr = 1 AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as penjualan,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as kpr,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as kpr_rp,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as tempo,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as tempo_rp
				"))
				->where("status_spr","=","1") 
				->get();	
            }else{
				$data = $db->table('konsumen_spr')
				->select(db::raw("
				sum(if(konsumen_spr.status_spr = 1 AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as penjualan,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as kpr,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as kpr_rp,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as tempo,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as tempo_rp
				"))
				->where("status_spr","=","1")
				->where("konsumen_spr.id_marketing",'=',$id_marketing)  
				->get();	 	    
            }
        }else{
            if($id_marketing == "all"){
				$data = $db->table('konsumen_spr')
				->select(db::raw("
				sum(if(konsumen_spr.status_spr = 1 AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as penjualan,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as kpr,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as kpr_rp,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as tempo,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as tempo_rp
				"))
				->where("status_spr","=","1")
				->where("konsumen_spr.id_properti",'=',$id_properti)  
				->get();	 	    
            }else{
                $data = $db->table('konsumen_spr')
				->select(db::raw("
				sum(if(konsumen_spr.status_spr = 1 AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as penjualan,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as kpr,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit = 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as kpr_rp,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', 1, 0)) as tempo,
				sum(if(konsumen_spr.status_spr = 1 and konsumen_spr.cara_bayar_unit <> 'kpr' AND konsumen_spr.tgl_transaksi between '$tanggal1' and '$tanggal2', gross_total, 0)) as tempo_rp
				"))
				->where("status_spr","=","1")
				->where("konsumen_spr.id_properti",'=',$id_properti)
				->where("konsumen_spr.id_marketing",'=',$id_marketing)  
				->get();	 	        
            }

        }
		
        
        return $data;
    }	
	 
	public function listckonsumen($id,  $tanggal1, $tanggal2){

		$db = DB::connection('mysql');
		$data = $db->select("SELECT * FROM konsumen where id_marketing = '$id' and 
							iskonsumen='0' and (date(created_at) between '$tanggal1' 
							and '$tanggal2')
							"
							);
		return $data;
	}
	public function penjualan($id,$tanggal1,$tanggal2){

		$db = DB::connection('mysql');
		$data = $db->table('konsumen_spr')
				->select(db::raw("konsumen_spr.*, konsumen.nama as nama_konsumen,properti.nama as nama_properti, properti_kav.nama as nama_kav"))
				->leftjoin("konsumen","konsumen_spr.id_konsumen","=","konsumen.id")
				->leftjoin("properti","konsumen_spr.id_properti","=","properti.id")
				->leftjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
				->where("konsumen_spr.id_marketing","=",$id)
				->where("konsumen_spr.status_spr","=",1)
				->whereBetween("konsumen_spr.tgl_transaksi",[$tanggal1,$tanggal2])
				->OrderBy('konsumen.nama', 'ASC')
				->get();	    
		return $data;
	}
}
