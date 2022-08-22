<?php
namespace App\Modules\Lapharianmkt\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Lapharianmkt extends Model {
    protected $table = 'SELECT * FROM marketing_harian';
    public $timestamps = true;


    public function listuser()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('users')->OrderBy('name', 'ASC')->get();	    return $listuser;
    }	

    
    public function listall($tanggal1,$tanggal2,$id_properti,$id_marketing)
	{
        $db = DB::connection('mysql');

        if($id_properti == "all"){
            if($id_marketing == "all"){
                $listuser = $db->table('marketing_aktifitas')
                ->select(DB::raw("marketing_aktifitas.tanggal, marketing_aktifitas.melalui, marketing_aktifitas.keterangan, marketing_aktifitas.hasil, marketing_aktifitas.created_by,
                konsumen.nama as nama_konsumen,konsumen.telp as telp,
                jenis_progres_konsumen.nama as nama_progres,users.name as nama_marketing"))
                ->leftjoin("users","marketing_aktifitas.id_marketing","=","users.id")
                ->leftjoin('konsumen', 'marketing_aktifitas.id_konsumen','=','konsumen.id')
                ->leftjoin('properti', 'marketing_aktifitas.id_properti','=','properti.id')
                ->leftjoin('jenis_progres_konsumen', 'marketing_aktifitas.id_progres','=','jenis_progres_konsumen.id')
                ->whereBetween('marketing_aktifitas.tanggal', [$tanggal1, $tanggal2])
                ->OrderBy('marketing_aktifitas.created_at','DESC')->get();	    	    
            }else{
                $listuser = $db->table('marketing_aktifitas')
                ->select(DB::raw("marketing_aktifitas.tanggal, marketing_aktifitas.melalui, marketing_aktifitas.keterangan, marketing_aktifitas.hasil, marketing_aktifitas.created_by,
                konsumen.nama as nama_konsumen,konsumen.telp as telp,
                jenis_progres_konsumen.nama as nama_progres,users.name as nama_marketing"))
                ->leftjoin("users","marketing_aktifitas.id_marketing","=","users.id")
                ->leftjoin('konsumen', 'marketing_aktifitas.id_konsumen','=','konsumen.id')
                ->leftjoin('properti', 'marketing_aktifitas.id_properti','=','properti.id')
                ->leftjoin('jenis_progres_konsumen', 'marketing_aktifitas.id_progres','=','jenis_progres_konsumen.id')
                ->whereBetween('marketing_aktifitas.tanggal', [$tanggal1, $tanggal2])
                ->where('marketing_aktifitas.id_marketing','=',$id_marketing)
                ->OrderBy('marketing_aktifitas.created_at','DESC')->get();	    
            }
        }else{
            if($id_marketing == "all"){
                $listuser = $db->table('marketing_aktifitas')
                ->select(DB::raw("marketing_aktifitas.tanggal, marketing_aktifitas.melalui, marketing_aktifitas.keterangan, marketing_aktifitas.hasil, marketing_aktifitas.created_by,
                konsumen.nama as nama_konsumen,konsumen.telp as telp,
                jenis_progres_konsumen.nama as nama_progres,users.name as nama_marketing"))
                ->leftjoin("users","marketing_aktifitas.id_marketing","=","users.id")
                ->leftjoin('konsumen', 'marketing_aktifitas.id_konsumen','=','konsumen.id')
                ->leftjoin('properti', 'marketing_aktifitas.id_properti','=','properti.id')
                ->leftjoin('jenis_progres_konsumen', 'marketing_aktifitas.id_progres','=','jenis_progres_konsumen.id')
                ->whereBetween('marketing_aktifitas.tanggal', [$tanggal1, $tanggal2])
                ->where('marketing_aktifitas.id_properti','=',$id_properti)
                ->OrderBy('marketing_aktifitas.created_at','DESC')->get();	    
            }else{
                $listuser = $db->table('marketing_aktifitas')
                ->select(DB::raw("marketing_aktifitas.tanggal, marketing_aktifitas.melalui, marketing_aktifitas.keterangan, marketing_aktifitas.hasil, marketing_aktifitas.created_by,
                konsumen.nama as nama_konsumen,konsumen.telp as telp,
                jenis_progres_konsumen.nama as nama_progres,users.name as nama_marketing"))
                ->leftjoin("users","marketing_aktifitas.id_marketing","=","users.id")
                ->leftjoin('konsumen', 'marketing_aktifitas.id_konsumen','=','konsumen.id')
                ->leftjoin('properti', 'marketing_aktifitas.id_properti','=','properti.id')
                ->leftjoin('jenis_progres_konsumen', 'marketing_aktifitas.id_progres','=','jenis_progres_konsumen.id')
                ->whereBetween('marketing_aktifitas.tanggal', [$tanggal1, $tanggal2])
                ->where('marketing_aktifitas.id_properti','=',$id_properti)
                ->where('marketing_aktifitas.id_marketing','=',$id_marketing)
                ->OrderBy('marketing_aktifitas.created_at','DESC')->get();	    
            }

        }
		
        
        return $listuser;
    }	
}
