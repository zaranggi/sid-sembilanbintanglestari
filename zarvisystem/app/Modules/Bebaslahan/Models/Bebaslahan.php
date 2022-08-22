<?php
namespace App\Modules\Bebaslahan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Bebaslahan extends Model {
    protected $table = 'm_bebas_lahan';
    public $timestamps = true;

    public function listdata()
	{
        $db = DB::connection('mysql');
         
		$data = $db->select("select a.*,
        if(a.status_bebas_lahan = 0,'Pengajuan',if(a.status_bebas_lahan = 1,'Disetujui','Ditolak')) as status_bebas_lahan,
        b.nama as nama_properti from m_bebas_lahan a
        left join properti b on a.id_properti = b.id
        order by a.created_at desc;        
        ");
         
		return $data;
	}	
    public function detail($id)
	{
        $db = DB::connection('mysql');
         
		$data = $db->select("select a.*,b.nama as nama_properti 
        from m_bebas_lahan a
        left join properti b on a.id_properti = b.id
        where a.id='$id'
        order by a.created_at desc;        
        ");
         
		return $data;
	}
    public function gettermin($id)
	{
        $db = DB::connection('mysql');
         
		$data = $db->select("select * from m_bebas_lahan_termin where id_bebas_lahan = '$id'");
         
		return $data;
	}
    public function dataproperti()
	{
        $db = DB::connection('mysql');
         
		$data = $db->select("select id,nama from properti");
         
		return $data;
	}
    
    public function listdoc($id)
	{
        $db = DB::connection('mysql');
         
		$data = $db->select("select * from m_bebas_lahan_doc where id_bebas_lahan = '$id'");
         
		return $data;
	}
    
    public function inserttermin($id,$termin,$nilai)
	{
        $db = DB::connection('mysql');
         
        $data = DB::table('m_bebas_lahan_termin')
        ->insert(
                    [
                        'id_bebas_lahan'     => $id,
                        'termin'       => $termin,
                        'nilai'    => $nilai
                    ]
                );
         
		return $data;
	}
    
    
    public function updatetermin($id,$termin,$nilai)
	{
        $db = DB::connection('mysql');
        
        $data = $db->select("select * from m_bebas_lahan_termin where id_bebas_lahan = '$id' and termin='$termin'");
        if(count($data) > 0){
            DB::table('m_bebas_lahan_termin')
            ->where('id_bebas_lahan', $id)
            ->where('termin', $termin)
            ->update(
                        [
                            'nilai'    => $nilai
                        ]
                    );
        }else{
            $data = DB::table('m_bebas_lahan_termin')
            ->insert(
                        [
                            'id_bebas_lahan'     => $id,
                            'termin'       => $termin,
                            'nilai'    => $nilai
                        ]
                    );
                
        }
            
         
		return "Sukses";
	}
    public function deltermin($id,$termin)
	{
        DB::table('m_bebas_lahan_termin')
        ->where('termin', '>=', $termin)
        ->where('id_bebas_lahan', '=', $id)
        ->delete(); 
		return "Sukses";
	}


    public function simpandoc($id,$nama,$photo)
	{
        $db = DB::connection('mysql');
         
        $data = DB::table('m_bebas_lahan_doc')
        ->insert(
                    [
                        'id_bebas_lahan' => $id,
                        'nama'       => $nama,
                        'photo'    => $photo
                    ]
                );
         
		return $data;
	}	
    

    public function insertwa($data)
	{
        
        DB::table('wa')
        ->insert(
                    [
                        'pesan' => $data,
                        'status_wa'=> 0,
                    ]
                );
         
		return "Sukses";
	}	
	
}
