<?php
namespace App\Modules\Appmrabp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Appmrabp extends Model {
    protected $table = 'mrab_proyek';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
        $data = $db->select("SELECT
        a.id,b.nama as nama_properti,a.judul, a.hari,
        a.id_properti,
        a.`status`,gross, a.created_by
        FROM mrab_proyek a
        LEFT JOIN properti b on a.id_properti=b.id
        where a.status in(1,2,3)
		and a.kategori = 'Proyek'
        Order by a.id ");
        
        return $data;

    }	 

    public function approve($id){ 

		$db = DB::connection('mysql');
        $data = $db->table('mrab_proyek')
                    ->where('id', $id)
                    ->update([
                        'status' => "2",
                        'approved_by' => Auth::user()->name,
                        'approved_date' => date("Y-m-d"),
                                 ]);

        $data = $db->table('mrab_material_proyek') 
                    ->where('id_mrabp', $id)
                    ->update(['status' => "2"]);
        return $data;
        
    }
    
    public function reject($id){ 

		$db = DB::connection('mysql');
        $data = $db->table('mrab_proyek')
                    ->where('id', $id)
                    ->update([
                        'status' => "3",
                        'approved_by' => Auth::user()->name,
                        'approved_date' => date("Y-m-d"),
                                 ]);

        $data = $db->table('mrab_material_proyek') 
                    ->where('id_mrabp', $id)
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
	
	public function rabm($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('mrab_material_proyek')
				->select(db::raw("mrab_material_proyek.*, prodmast.nama"))
				->leftJoin("prodmast","mrab_material_proyek.prdcd","=","prodmast.prdcd")
				->where("id_mrabp","=",$id)
				->OrderBy('id', 'ASC')
				->get();	    
		return $data;
	}
	
	
	public function viewjob($id)
	{
		$db = DB::connection('mysql');
		$data = $db->select("SELECT a.* , b.nama FROM mrab_job_proyek a
						left join jenis_progres_proyek b on a.id_pekerjaan =b.id where a.id_mrabp='$id'");	    
		return $data;
	}


}
