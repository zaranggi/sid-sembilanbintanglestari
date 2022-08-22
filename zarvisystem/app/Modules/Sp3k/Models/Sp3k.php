<?php
namespace App\Modules\Sp3k\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Sp3k extends Model {
    protected $table = 'sp3k';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('sp3k')
        ->select(db::raw("sp3k.*,properti.nama as nama_properti, properti_kav.nama as nama_kav ,
							konsumen.nama, konsumen_spr.kode,konsumen.created_by"))
        ->leftjoin("konsumen_spr","sp3k.id_spr","=","konsumen_spr.id")
        ->leftjoin("konsumen","konsumen_spr.id_konsumen","=","konsumen.id")  
        ->leftjoin("properti","konsumen_spr.id_properti","=","properti.id")  
        ->leftjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")            
        ->OrderBy('id', 'DESC')->get();	    
        return $listuser;
    }	
    
    public function listbank(){ 

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;
        
	}

    

}
