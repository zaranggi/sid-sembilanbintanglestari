<?php
namespace App\Modules\Appizin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Appizin extends Model {
    protected $table = 'izin';
    public $timestamps = true;


    public function listizin(){ 

        $db = DB::connection('mysql');
        $data = $db->select("SELECT a.*,b.name,b.nik,c.name_jabatan FROM izin a 
                            left join users b on a.id_user = b.id
                            left join jabatan c on b.id_jabatan = c.id_jabatan
                            where a.status = 1
                            ORDER BY a.id DESC;");
        return $data;
            
    }
      


}
