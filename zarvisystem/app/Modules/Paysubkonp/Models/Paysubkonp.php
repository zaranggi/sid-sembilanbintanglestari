<?php
namespace App\Modules\Paysubkonp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Paysubkonp extends Model {
    protected $table = 'termin_proyek';
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
		from termin_proyek_approval a
		left join spk_proyek b on a.id_spk = b.id
		left join subkon c on b.id_subkon = c.id
		left join properti e on b.id_properti = e.id
		left join properti_kav f on b.id_kav = f.id
		where a.status = 2
		and b.kategori='Proyek';");	    
		return $listuser;
	}
	  

	
}
