<?php
namespace App\Modules\Gl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Gl extends Model {
    protected $table = 'daftar_akun';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
        $data = $db->select("SELECT
        a.id,b.nama as nama_properti,
        a.id_properti,
        `status`,
        tipe_unit,sum(gross) as gross, group_concat(distinct created_by)  as created_by
        FROM mrab a
        LEFT JOIN properti b on a.id_properti=b.id
        where a.status in(1,2,3)
        group by a.id_properti, a.tipe_unit ");
        
        return $data;

    }	 
  

}
