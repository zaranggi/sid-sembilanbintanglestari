<?php
namespace App\Modules\Setprogproperti\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Setprogproperti extends Model {
    protected $table = 'jenis_progres_bangunan';
    public $timestamps = true; 


    public function listall()
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT 
                                   a.* , b.nama as nama_kategori 
                                FROM
                                jenis_progres_bangunan  a
                                LEFT JOIN jenis_progres_kategori b on a.id_main = b.id 
                                ORDER BY b.id , a.id")->get();	    
        return $listuser;
    }	


}
