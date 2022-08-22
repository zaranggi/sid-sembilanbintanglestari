<?php
namespace App\Modules\Progproyek\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Progproyek extends Model {
    protected $table = 'progres_proyek';
    public $timestamps = true;

    public function dataall()
	{
		
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
						and d.kategori='Proyek'
						ORDER BY a.id desc
					");	    
        
        return $listuser;
    }
	
	public function detail($id,$jenis_spk)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("
				select progres_proyek.*,jenis_spk.nama_spk, jenis_progres_proyek.nama as nama_pekerjaan
				from `progres_proyek`
				left join `jenis_spk` on `progres_proyek`.`jenis_spk` = `jenis_spk`.`id`
				left join `jenis_progres_proyek` on `progres_proyek`.`id_pekerjaan` = `jenis_progres_proyek`.`id`
				where `progres_proyek`.`id_spr` = '$id' and jenis_spk='$jenis_spk';");	    
        
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
        FROM progres_proyek A
        LEFT JOIN TERMIN B ON A.ID_TERMIN=B.ID
        LEFT JOIN jenis_progres_proyek C ON A.ID_JENIS = C.ID        
        WHERE B.ID_SPK= $id");	    
        
        return $listuser;
    }
    
    public function cekspk($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT KODE FROM SPK WHERE ID= $id");	    
        
        return $listuser;
    }

    public function listuser()
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('users')->OrderBy('name', 'ASC')->get();	    
        
        return $listuser;
    }	 
}
