<?php
namespace App\Modules\Lapprogproyek\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
/**
 * @property array|null|string name
 */
class Lapprogproyek extends Model {
    protected $table = 'progres_proyek';
    public $timestamps = true;
	
	public function perumahan()
	{
        $db = DB::connection('mysql');
        
            $data = $db->table('properti')
            ->select(db::raw("properti.*, gambar,count(distinct properti_kav.id) as tunit"))
            ->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
            ->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti') 
            ->groupBy('properti.id')
            ->OrderBy('properti.id', 'ASC')
            ->get();
             
		return $data;
	}	


    public function dataall($id)
	{
		$id_marketing = Auth::user()->id;
		$db = DB::connection('mysql');
		 
		 $listuser = $db->select("
						SELECT a.*, b.bobot,b.ach , d.judul, c.nama as nama_properti FROM spk_proyek a
						LEFT JOIN (
						  SELECT id_spk,sum(bobot) as bobot,count(*) as t, sum(if(`status` = 1,bobot,0)) as ach
						  FROM progres_proyek
						  group by id_spk
						) b on a.id = b.id_spk
						LEFT JOIN mrab_proyek d on a.id_mrabp = d.id
						LEFT JOIN properti c on a.id_properti = c.id
						WHERE a.status =4
						and a.id_properti='$id'
						and d.kategori='Proyek'
						ORDER BY a.id desc
					");	    

			
		 
        
        return $listuser;
    }
	public function spk($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT a.*, b.nama as nama_pekerjaan
									FROM progres_proyek a 
									left join jenis_progres_proyek b on a.id_pekerjaan = b.id
									left join spk_proyek c on a.id_spk = c.id
									WHERE a.id_spk ='$id' and c.status = '4';");	    
        
        return $listuser;
    }
	
	 


    public function progres($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT A.ID, C.NAMA ,B.TERMIN, A.TANGGAL,A.KETERANGAN,A.PHOTO,A.STATUS, B.NILAI,B.KET_TERMIN 
        FROM PROGRES_BANGUN A
        LEFT JOIN TERMIN B ON A.ID_TERMIN=B.ID
        LEFT JOIN JENIS_PROGRES_BANGUNAN C ON A.ID_JENIS = C.ID        
        WHERE B.ID_SPK= $id");	    
        
        return $listuser;
    }
    
    public function cekspk($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT KODE FROM SPK WHERE ID= $id");	    
        
        return $listuser;
    }
	
	public function nama_perumahan($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT nama FROM properti WHERE id= $id");	    
        
        return $listuser;
    }

    public function listuser()
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('users')->OrderBy('name', 'ASC')->get();	    
        
        return $listuser;
    }	 
}
