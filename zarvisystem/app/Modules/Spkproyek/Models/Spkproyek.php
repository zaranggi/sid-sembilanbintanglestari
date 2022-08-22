<?php
namespace App\Modules\Spkproyek\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * @property array|null|string name
 */
class Spkproyek extends Model {
    protected $table = 'spk_proyek';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('spk_proyek')
        ->select(db::raw("spk_proyek.*, mrab_proyek.judul,properti.nama as nama_properti"))            
        ->leftjoin("mrab_proyek","spk_proyek.id_mrabp","=","mrab_proyek.id")          
        ->leftjoin("properti","spk_proyek.id_properti","=","properti.id")
		->where("spk_proyek.kategori","=","Proyek")
        ->OrderBy('spk_proyek.id', 'DESC')->get();	    
        return $listuser;
    }	
    
    public function dirman(){ 

		$db = DB::connection('mysql');
        $data = $db->table('users')
                    ->wherein("id_jabatan",[2,3,4])
                    ->OrderBy('name', 'ASC')->get();
        return $data;
        
    }
    
    public function jenis_spk(){ 

		$db = DB::connection('mysql');
        $spk = $db->select("SELECT a.*, b.nama as nama_properti FROM mrab_proyek a left join properti b on a.id_properti = b.id where a.kategori='Proyek' and a.status = 2");
        
        return $spk;
        
    }
    public function job(){ 

		$db = DB::connection('mysql');
        $spk = $db->table('jenis_progres_bangunan')->get();
        
        return $spk;
        
	}

    public function subkon(){ 

		$db = DB::connection('mysql');
        $data = $db->table('subkon')
                    ->OrderBy('nama', 'ASC')->get();
        return $data;
        
    }
    
    
    public function update_termin($idspk){ 

		$db = DB::connection('mysql');
        $data = $db->table('termin_proyek')
                    ->where('id_spk', $idspk)
                    ->update(['diajukanoleh' => Auth::user()->name, 'diajukantgl' => date("Y-m-d"), 'status' => 1]);
        return $data;
        
    }
    
    public function spkdetail($idspk){ 

		$db = DB::connection('mysql');
        $data = $db->select("select
                                a.*,
                                b.name as nama_pihak1,
                                c.nama as nama_subkon,
                                e.nama as nama_properti,
								d.judul
                                from spk_proyek a
                                left join users b on a.pihak1 = b.id
                                left join subkon c on a.id_subkon = c.id
                                left join properti e on a.id_properti = e.id
                                left join mrab_proyek d on a.id_mrabp = d.id
						where a.id = $idspk");
       
        return $data;
        
	}
	
	public function termindetail($idspk){ 

		$db = DB::connection('mysql');
        $data = $db->select("select * from termin_proyek where id_spk = $idspk");
       
        return $data;
        
	}
	
	public function jobdetail($idspk){ 

		$db = DB::connection('mysql');
        $data = $db->select("
					select a.*, d.nama as nama_pekerjaan 
					from progres_proyek a
					left join jenis_progres_proyek d on a.id_pekerjaan = d.id
					where a.id_spk = $idspk;");
       
        return $data;
        
    }
    

}
