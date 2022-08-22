<?php
namespace App\Modules\Kkso\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Kkso extends Model {
    protected $table = 'stmast';
    public $timestamps = true;

    public function dataall()
	{
        $db = DB::connection('mysql');
        
		$data = $db->select("SELECT a.*,b.nama,b.satuan,b.merk,b.price 
		FROM stmast a 
		left join prodmast b on a.prdcd = b.prdcd;");
        
		return $data;
	}	
	
}
