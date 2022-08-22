<?php
namespace App\Modules\Paypomaterial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Modules\Materialmasuk\Models\Stmast;
use App\Modules\Materialmasuk\Models\Prodmast;

/** 
 * @property array|null|string name
 */
class Paypomaterial extends Model {
    protected $table = 'po_bayar';
    public $timestamps = true;


    public function listbank(){ 

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;
        
	}
    public function dataall()
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("SELECT a.*,b.nama as nama_rekanan,b.alamat, b.kontak FROM po_bayar a left join rekanan b on a.id_vendor = b.id
		order by a.id desc;");	    
		return $listuser;
	}
	
	 

	
}
