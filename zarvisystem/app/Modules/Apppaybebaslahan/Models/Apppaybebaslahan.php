<?php
namespace App\Modules\Apppaybebaslahan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Apppaybebaslahan extends Model {
    protected $table = 'm_bebas_lahan_termin';
    public $timestamps = true;


    public function listbank(){ 

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;
        
	}
	public function listall()
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("
		SELECT a.*, if(b.total > 0,'Ada Pengajuan','Tidak Ada Pengajuan') AS total_pengajuan FROM (
			SELECT a.*,b.nama AS nama_properti
			FROM m_bebas_lahan a
			LEFT JOIN properti b ON a.id_properti = b.id
		) a 
		LEFT JOIN 
		(select count(*) as total,id_bebas_lahan from m_bebas_lahan_termin where status = 1 group by id) b ON a.id = b.id_bebas_lahan
		");	    
		return $listuser;
	}

	    
    public function approve($id){ 

        $db = DB::connection('mysql'); 
            
        $data = $db->table('m_bebas_lahan_termin')
            ->where('id', "$id")
            ->update(['status' => "2", 'apptgl' => date('Y-m-d')]);  

        return $data; 
    }  
    public function reject($id){ 

        $db = DB::connection('mysql'); 
            
        $data = $db->table('m_bebas_lahan_termin')
            ->where('id', "$id")
            ->update(['status' => "3", 'apptgl' => date('Y-m-d')]);  

        return $data; 
    }
    

	public function detail($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("
		SELECT a.*,b.nama AS nama_properti FROM m_bebas_lahan a
		LEFT JOIN properti b ON a.id_properti = b.id
		where a.id='$id';");	    
		return $listuser;
	}
	
	public function detail_termin($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("
		SELECT a.*, c.nama AS nama_properti, if(status = 0,'Belum Pengajuan', if(a.status=1,'Diajukan',if(a.status='2','Disetujui','Ditolak'))) as status_pembayaran,b.tanggal_jth_tempo
		FROM m_bebas_lahan_termin a 
		left join m_bebas_lahan b on a.id_bebas_lahan = b.id
		LEFT JOIN properti c ON b.id_properti = c.id
		where a.id_bebas_lahan = '$id'
		ORDER BY a.id DESC;");	    
		return $listuser;
	}
	
	  
	public function detail_termin_his($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("
		SELECT a.*, c.nama AS nama_properti, if(a.status = 0,0,nilai)  as bayar,if(status = 0,'Belum Pengajuan', if(a.status=1,'Diajukan',if(a.status='2','Disetujui','Ditolak'))) as status_pembayaran,b.tanggal_jth_tempo
		FROM m_bebas_lahan_termin a 
		left join m_bebas_lahan b on a.id_bebas_lahan = b.id
		LEFT JOIN properti c ON b.id_properti = c.id
		where a.id_bebas_lahan = '$id' and status = 2
		ORDER BY a.id DESC;");	    
		return $listuser;
	}
	
	  
	public function datacetak($kode)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("select a.*,b.kode as kode_mou,c.nama as nama_properti,
		d.nama as nama_kav,e.kode as kode_konsumen,f.kode as kode_pembayaran,d.tipe as tipe_unit
		from mtran_konsumen a
		left join konsumen_spr b on a.id_spr = b.id
		left join properti c on b.id_properti = c.id
		left join properti_kav d on b.id_kav = d.id
		left join konsumen e on b.id_konsumen = e.id
		left join mtran f on a.kode = f.kode_tagihan
		where a.kode='$kode'; ");	    
		return $listuser;
	}
	



	
}
