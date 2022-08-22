<?php
namespace App\Modules\Paysubkon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Paysubkon extends Model {
    protected $table = 'termin';
    public $timestamps = true;


    public function listbank(){ 

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;
        
	}
    public function dataall()
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("SELECT a.*, c.nama as nama_subkon, b.kode,e.nama as nama_properti, f.nama as nama_kav,f.tipe as tipe_unit
		from termin_approval a
		left join spk b on a.id_spk = b.id
		left join subkon c on b.id_subkon = c.id
		left join properti e on b.id_properti = e.id
		left join properti_kav f on b.id_kav = f.id
		where a.status = 2;");	    
		return $listuser;
	}
	  

	
}
