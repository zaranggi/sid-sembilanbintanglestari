<?php
namespace App\Modules\Appmrab\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Appmrab extends Model {
    protected $table = 'mrab';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
        $data = $db->select("SELECT
        a.id,b.nama as nama_properti,
        a.id_properti,
		a.kode,
        `status`,
        tipe_unit,sum(gross) as gross, group_concat(distinct created_by)  as created_by
        FROM mrab a
        LEFT JOIN properti b on a.id_properti=b.id
        where a.status in(1,2,3)
        group by a.id_properti, a.tipe_unit ");
        
        return $data;

    }	 

    public function approve($kode){ 

		$db = DB::connection('mysql');
        $data = $db->table('mrab')
                    ->where('kode', $kode)
                    ->update([
                        'status' => "2",
                        'approved_by' => Auth::user()->name,
                        'approved_date' => date("Y-m-d"),
                                 ]);

        $data = $db->table('mrab_material') 
                    ->where('kode', $kode)
                    ->update(['status' => "2"]);
        return $data;
        
    }
    
    public function reject($kode){ 

		$db = DB::connection('mysql');
        $data = $db->table('mrab')
                    ->where('kode', $kode)
                    ->update([
                        'status' => "3",
                        'approved_by' => Auth::user()->name,
                        'approved_date' => date("Y-m-d"),
                                 ]);

        $data = $db->table('mrab_material') 
                    ->where('kode', $kode)
                    ->update(['status' => "3"]);
        return $data;
        
	}
	public function namaproperti($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->select(db::raw("properti.nama as nama_properti ")) 
				->where("id","=",$id)
				->get();	    
		return $data;
	}	
	public function rabm($kode)
	{
		$db = DB::connection('mysql');
		$data = $db->table('mrab_material')
				->select(db::raw("mrab_material.*, prodmast.nama, prodmast.merk"))
				->leftJoin('prodmast','mrab_material.prdcd','=','prodmast.prdcd')
                ->where('kode', $kode)
				->OrderBy('id', 'ASC')
				->get();	    
		return $data;
	}
	public function job()
	{
		$db = DB::connection('mysql');
		$data = $db->table('jenis_progres_kategori')
				->OrderBy('id', 'ASC')
				->get();	    
		return $data;
	}


}
