<?php
namespace App\Modules\Lapbookingm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Lapbookingm extends Model {
    protected $table = 'booking_marketing';
    public $timestamps = true;

	 
	
	public function listall($tanggal1,$tanggal2,$id_properti,$id_marketing)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){
            if($id_marketing == "all"){
				$data = $db->select("select a.*, b.nama as nama_konsumen, c.nama as nama_properti,
									d.nama as nama_kav, d.tipe as tipe_unit, e.kode as kode_spr, f.name as nama_marketing
									from booking_marketing a
									left join konsumen b on a.id_konsumen = b.id
									left join properti c on a.id_properti = c.id
									left join properti_kav d on a.id_kav = d.id
									left join users f on a.id_marketing = f.id
									left join konsumen_spr e on a.id_properti = e.id_properti and a.id_kav = e.id
									where 
									a.tanggal between '$tanggal1' and '$tanggal2'
									order by a.tanggal desc");	      	    
            }else{
				$data = $db->select("select a.*, b.nama as nama_konsumen, c.nama as nama_properti,
									d.nama as nama_kav, d.tipe as tipe_unit, e.kode as kode_spr, f.name as nama_marketing
									from booking_marketing a
									left join konsumen b on a.id_konsumen = b.id
									left join properti c on a.id_properti = c.id
									left join properti_kav d on a.id_kav = d.id
									left join users f on a.id_marketing = f.id
									left join konsumen_spr e on a.id_properti = e.id_properti and a.id_kav = e.id
									where 
									a.id_marketing = '$id_marketing' 
									and a.tanggal between '$tanggal1' and '$tanggal2' 
									order by a.tanggal desc");	    	    
            }
        }else{
            if($id_marketing == "all"){
				$data = $db->select("select a.*, b.nama as nama_konsumen, c.nama as nama_properti,
									d.nama as nama_kav, d.tipe as tipe_unit, e.kode as kode_spr, f.name as nama_marketing
									from booking_marketing a
									left join konsumen b on a.id_konsumen = b.id
									left join properti c on a.id_properti = c.id
									left join properti_kav d on a.id_kav = d.id
									left join users f on a.id_marketing = f.id
									left join konsumen_spr e on a.id_properti = e.id_properti and a.id_kav = e.id
									where 
									a.id_properti = '$id_properti'
									and a.tanggal between '$tanggal1' and '$tanggal2'
									order by a.tanggal desc");	    
            }else{
                $data = $db->select("select a.*, b.nama as nama_konsumen, c.nama as nama_properti,
									d.nama as nama_kav, d.tipe as tipe_unit, e.kode as kode_spr, f.name as nama_marketing
									from booking_marketing a
									left join konsumen b on a.id_konsumen = b.id
									left join properti c on a.id_properti = c.id
									left join properti_kav d on a.id_kav = d.id
									left join users f on a.id_marketing = f.id
									left join konsumen_spr e on a.id_properti = e.id_properti and a.id_kav = e.id
									where 
									a.id_properti = '$id_properti' and a.id_marketing = '$id_marketing' 
									and a.tanggal between '$tanggal1' and '$tanggal2'
									order by a.tanggal desc");	  	        
            }

        }
		
        
        return $data;
    }	
	
     

}
